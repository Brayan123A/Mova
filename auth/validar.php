<?php

session_start();

require_once "../config/conexion.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit;
}


$accion = $_POST["accion"] ?? "";


/*
|--------------------------------------------------------------------------
| REGISTRO
|--------------------------------------------------------------------------
*/

if ($accion === "registro") {

    $nombre = trim($_POST["nombre"] ?? "");
    $usuario = trim($_POST["usuario"] ?? "");
    $correo = trim($_POST["correo"] ?? "");

    $password = $_POST["password"] ?? "";
    $confirmar = $_POST["confirmar_password"] ?? "";


    /*
    | Validaciones
    */

    if (
        $nombre === "" ||
        $usuario === "" ||
        $correo === "" ||
        $password === ""
    ) {

        header(
            "Location: registro.php?error="
            . urlencode("Todos los campos son obligatorios.")
        );

        exit;
    }


    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {

        header(
            "Location: registro.php?error="
            . urlencode("El correo electrónico no es válido.")
        );

        exit;
    }


    if (strlen($password) < 8) {

        header(
            "Location: registro.php?error="
            . urlencode("La contraseña debe tener mínimo 8 caracteres.")
        );

        exit;
    }


    if ($password !== $confirmar) {

        header(
            "Location: registro.php?error="
            . urlencode("Las contraseñas no coinciden.")
        );

        exit;
    }


    /*
    | Verificar usuario
    */

    $sql = "
        SELECT id
        FROM usuarios
        WHERE usuario = ?
        LIMIT 1
    ";

    $stmt = mysqli_prepare($conexion, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $usuario
    );

    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {

        mysqli_stmt_close($stmt);

        header(
            "Location: registro.php?error="
            . urlencode("Ese nombre de usuario ya existe.")
        );

        exit;
    }

    mysqli_stmt_close($stmt);


    /*
    | Verificar correo
    */

    $sql = "
        SELECT id
        FROM usuarios
        WHERE correo = ?
        LIMIT 1
    ";

    $stmt = mysqli_prepare($conexion, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $correo
    );

    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {

        mysqli_stmt_close($stmt);

        header(
            "Location: registro.php?error="
            . urlencode("Ese correo ya está registrado.")
        );

        exit;
    }

    mysqli_stmt_close($stmt);


    /*
    | Encriptar contraseña
    */

    $password_hash = password_hash(
        $password,
        PASSWORD_DEFAULT
    );


    /*
    | Crear usuario
    */

    $sql = "
        INSERT INTO usuarios
        (
            nombre,
            usuario,
            correo,
            password,
            estado
        )
        VALUES
        (?, ?, ?, ?, 'activo')
    ";

    $stmt = mysqli_prepare($conexion, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $nombre,
        $usuario,
        $correo,
        $password_hash
    );


    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);

        header(
            "Location: login.php?registro=exitoso"
        );

        exit;

    } else {

        mysqli_stmt_close($stmt);

        header(
            "Location: registro.php?error="
            . urlencode("No se pudo crear la cuenta.")
        );

        exit;
    }
}


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

if ($accion === "login") {

    $correo = trim($_POST["correo"] ?? "");
    $password = $_POST["password"] ?? "";


    if ($correo === "" || $password === "") {

        header(
            "Location: login.php?error="
            . urlencode("Completa todos los campos.")
        );

        exit;
    }


    $sql = "
        SELECT
            id,
            nombre,
            usuario,
            correo,
            password,
            foto_perfil,
            estado
        FROM usuarios
        WHERE correo = ?
        LIMIT 1
    ";


    $stmt = mysqli_prepare(
        $conexion,
        $sql
    );


    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $correo
    );


    mysqli_stmt_execute($stmt);


    $resultado = mysqli_stmt_get_result($stmt);


    if (mysqli_num_rows($resultado) === 0) {

        mysqli_stmt_close($stmt);

        header(
            "Location: login.php?error="
            . urlencode("Correo o contraseña incorrectos.")
        );

        exit;
    }


    $usuario_data = mysqli_fetch_assoc($resultado);


    /*
    | Verificar estado
    */

    if ($usuario_data["estado"] !== "activo") {

        mysqli_stmt_close($stmt);

        header(
            "Location: login.php?error="
            . urlencode("Tu cuenta se encuentra bloqueada.")
        );

        exit;
    }


    /*
    | Verificar contraseña
    */

    if (
        !password_verify(
            $password,
            $usuario_data["password"]
        )
    ) {

        mysqli_stmt_close($stmt);

        header(
            "Location: login.php?error="
            . urlencode("Correo o contraseña incorrectos.")
        );

        exit;
    }


    /*
    | Crear sesión
    */

    session_regenerate_id(true);

    $_SESSION["usuario_id"] = $usuario_data["id"];
    $_SESSION["nombre"] = $usuario_data["nombre"];
    $_SESSION["usuario"] = $usuario_data["usuario"];
    $_SESSION["correo"] = $usuario_data["correo"];
    $_SESSION["foto_perfil"] = $usuario_data["foto_perfil"];


    mysqli_stmt_close($stmt);


    /*
    | Ir al inicio
    */

    header(
        "Location: ../usuario/inicio.php"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| Acción desconocida
|--------------------------------------------------------------------------
*/

header("Location: login.php");
exit;