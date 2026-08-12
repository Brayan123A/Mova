
<?php

session_start();

require_once "../config/conexion.php";


/*
|--------------------------------------------------------------------------
| Verificar sesión
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION["usuario_id"])) {

    header("Location: ../auth/login.php");

    exit;
}


/*
|--------------------------------------------------------------------------
| Verificar método POST
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: crear.php");

    exit;
}


/*
|--------------------------------------------------------------------------
| Datos del usuario
|--------------------------------------------------------------------------
*/

$usuario_id = (int) $_SESSION["usuario_id"];


/*
|--------------------------------------------------------------------------
| Datos recibidos
|--------------------------------------------------------------------------
*/

$tipo = $_POST["tipo"] ?? "texto";

$contenido = trim(
    $_POST["contenido"] ?? ""
);


/*
|--------------------------------------------------------------------------
| Tipos permitidos
|--------------------------------------------------------------------------
*/

$tiposPermitidos = [
    "texto",
    "imagen",
    "evento",
    "encuesta"
];


if (!in_array($tipo, $tiposPermitidos, true)) {

    header(
        "Location: crear.php?error=tipo"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| Variable para imagen
|--------------------------------------------------------------------------
*/

$imagenNombre = null;


/*
|--------------------------------------------------------------------------
| Subir imagen
|--------------------------------------------------------------------------
*/

if (
    isset($_FILES["imagen"]) &&
    $_FILES["imagen"]["error"] !== UPLOAD_ERR_NO_FILE
) {

    if (
        $_FILES["imagen"]["error"]
        !== UPLOAD_ERR_OK
    ) {

        header(
            "Location: crear.php?error=imagen"
        );

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Tamaño máximo: 5 MB
    |--------------------------------------------------------------------------
    */

    $maxSize = 5 * 1024 * 1024;


    if (
        $_FILES["imagen"]["size"]
        > $maxSize
    ) {

        header(
            "Location: crear.php?error=pesada"
        );

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Validar MIME
    |--------------------------------------------------------------------------
    */

    $finfo = finfo_open(FILEINFO_MIME_TYPE);

    $mime = finfo_file(
        $finfo,
        $_FILES["imagen"]["tmp_name"]
    );

    finfo_close($finfo);


    $mimePermitidos = [
        "image/jpeg" => "jpg",
        "image/png"  => "png",
        "image/webp" => "webp"
    ];


    if (
        !isset(
            $mimePermitidos[$mime]
        )
    ) {

        header(
            "Location: crear.php?error=formato"
        );

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Crear carpeta uploads
    |--------------------------------------------------------------------------
    */

    $carpeta = "../uploads/publicaciones/";


    if (!is_dir($carpeta)) {

        mkdir(
            $carpeta,
            0755,
            true
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Nombre único
    |--------------------------------------------------------------------------
    */

    $extension =
        $mimePermitidos[$mime];


    $imagenNombre =
        uniqid("mova_", true)
        . "."
        . $extension;


    $rutaFinal =
        $carpeta . $imagenNombre;


    /*
    |--------------------------------------------------------------------------
    | Mover archivo
    |--------------------------------------------------------------------------
    */

    if (
        !move_uploaded_file(
            $_FILES["imagen"]["tmp_name"],
            $rutaFinal
        )
    ) {

        header(
            "Location: crear.php?error=subida"
        );

        exit;
    }

}


/*
|--------------------------------------------------------------------------
| Validar contenido
|--------------------------------------------------------------------------
*/

/*
   Una publicación de texto, imagen o evento
   necesita algún contenido.
*/

if (
    $tipo !== "encuesta" &&
    $contenido === "" &&
    $imagenNombre === null
) {

    header(
        "Location: crear.php?error=contenido"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| Eventos
|--------------------------------------------------------------------------
*/

if ($tipo === "evento") {

    $eventoNombre =
        trim(
            $_POST["evento_nombre"] ?? ""
        );

    $eventoFecha =
        trim(
            $_POST["evento_fecha"] ?? ""
        );

    $eventoHora =
        trim(
            $_POST["evento_hora"] ?? ""
        );

    $eventoLugar =
        trim(
            $_POST["evento_lugar"] ?? ""
        );

    $eventoDescripcion =
        trim(
            $_POST["evento_descripcion"] ?? ""
        );


    if ($eventoNombre === "") {

        header(
            "Location: crear.php?error=evento"
        );

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Guardar información del evento dentro del contenido
    |--------------------------------------------------------------------------
    */

    $contenido =
        "EVENTO: " . $eventoNombre
        . "\n\n"
        . "Fecha: " . $eventoFecha
        . "\n"
        . "Hora: " . $eventoHora
        . "\n"
        . "Lugar: " . $eventoLugar
        . "\n\n"
        . $eventoDescripcion;
}


/*
|--------------------------------------------------------------------------
| Encuestas
|--------------------------------------------------------------------------
*/

if ($tipo === "encuesta") {

    $pregunta =
        trim(
            $_POST["encuesta_pregunta"] ?? ""
        );

    $opcion1 =
        trim(
            $_POST["opcion_1"] ?? ""
        );

    $opcion2 =
        trim(
            $_POST["opcion_2"] ?? ""
        );

    $opcion3 =
        trim(
            $_POST["opcion_3"] ?? ""
        );

    $opcion4 =
        trim(
            $_POST["opcion_4"] ?? ""
        );


    if (
        $pregunta === "" ||
        $opcion1 === "" ||
        $opcion2 === ""
    ) {

        header(
            "Location: crear.php?error=encuesta"
        );

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | Crear contenido de encuesta
    |--------------------------------------------------------------------------
    */

    $contenido =
        "ENCUESTA: "
        . $pregunta
        . "\n\n"
        . "1. "
        . $opcion1
        . "\n"
        . "2. "
        . $opcion2;


    if ($opcion3 !== "") {

        $contenido .=
            "\n3. " . $opcion3;
    }


    if ($opcion4 !== "") {

        $contenido .=
            "\n4. " . $opcion4;
    }

}


/*
|--------------------------------------------------------------------------
| Insertar publicación
|--------------------------------------------------------------------------
*/

$sql = "
    INSERT INTO publicaciones
    (
        usuario_id,
        contenido,
        imagen,
        tipo,
        estado
    )
    VALUES
    (
        ?,
        ?,
        ?,
        ?,
        'publicada'
    )
";


$stmt = mysqli_prepare(
    $conexion,
    $sql
);


if (!$stmt) {

    /*
    |--------------------------------------------------------------------------
    | Si falla el SQL, eliminar imagen subida
    |--------------------------------------------------------------------------
    */

    if (
        $imagenNombre !== null &&
        file_exists($rutaFinal)
    ) {

        unlink($rutaFinal);
    }


    die(
        "Error al preparar la publicación: "
        . mysqli_error($conexion)
    );
}


mysqli_stmt_bind_param(
    $stmt,
    "isss",
    $usuario_id,
    $contenido,
    $imagenNombre,
    $tipo
);


if (
    !mysqli_stmt_execute($stmt)
) {

    /*
    |--------------------------------------------------------------------------
    | Eliminar imagen si el INSERT falla
    |--------------------------------------------------------------------------
    */

    if (
        $imagenNombre !== null &&
        file_exists($rutaFinal)
    ) {

        unlink($rutaFinal);
    }


    mysqli_stmt_close($stmt);


    die(
        "Error al guardar la publicación: "
        . mysqli_error($conexion)
    );
}


mysqli_stmt_close($stmt);


/*
|--------------------------------------------------------------------------
| Redirigir al inicio
|--------------------------------------------------------------------------
*/

header(
    "Location: ../usuario/inicio.php?publicado=1"
);

exit;

