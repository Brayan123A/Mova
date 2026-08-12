<?php

session_start();

require_once "../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: registro.php");
    exit;
}


/*
|--------------------------------------------------------------------------
| Recibir datos
|--------------------------------------------------------------------------
*/

$nombre = trim($_POST["nombre"] ?? "");
$usuario = trim($_POST["usuario"] ?? "");
$correo = trim($_POST["correo"] ?? "");
$password = $_POST["password"] ?? "";
$confirmar_password = $_POST["confirmar_password"] ?? "";


/*
|--------------------------------------------------------------------------
| Validaciones
|--------------------------------------------------------------------------
*/

if (
    empty($nombre) ||
    empty($usuario) ||
    empty($correo) ||
    empty($password) ||
    empty($confirmar_password)
) {
    die("Todos los campos son obligatorios.");
}


if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("El correo electrónico no es válido.");
}


if ($password !== $confirmar_password) {
    die("Las contraseñas no coinciden.");
}


if (strlen($password) < 8) {
    die("La contraseña debe tener mínimo 8 caracteres.");
}


if (!preg_match('/^[a-zA-Z0-9_.]+$/', $usuario)) {
    die("El usuario solo puede contener letras, números, puntos y guiones bajos.");
}


/*
|--------------------------------------------------------------------------
| Comprobar usuario
|--------------------------------------------------------------------------
*/

$sql = "
    SELECT id
    FROM usuarios
    WHERE usuario = ?
    LIMIT 1
";

$stmt = $conexion->prepare($sql);

$stmt->bind_param(
    "s",
    $usuario
);

$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {

    $stmt->close();

    die("El nombre de usuario ya está registrado.");

}

$stmt->close();


/*
|--------------------------------------------------------------------------
| Comprobar correo
|--------------------------------------------------------------------------
*/

$sql = "
    SELECT id
    FROM usuarios
    WHERE correo = ?
    LIMIT 1
";

$stmt = $conexion->prepare($sql);

$stmt->bind_param(
    "s",
    $correo
);

$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {

    $stmt->close();

    die("El correo electrónico ya está registrado.");

}

$stmt->close();


/*
|--------------------------------------------------------------------------
| Encriptar contraseña
|--------------------------------------------------------------------------
*/

$password_hash = password_hash(
    $password,
    PASSWORD_DEFAULT
);


/*
|--------------------------------------------------------------------------
| Crear usuario
|--------------------------------------------------------------------------
*/

$sql = "
    INSERT INTO usuarios
    (
        nombre,
        usuario,
        correo,
        password
    )
    VALUES
    (?, ?, ?, ?)
";

$stmt = $conexion->prepare($sql);

$stmt->bind_param(
    "ssss",
    $nombre,
    $usuario,
    $correo,
    $password_hash
);


if (!$stmt->execute()) {

    die(
        "No se pudo crear la cuenta: "
        . $stmt->error
    );

}


/*
|--------------------------------------------------------------------------
| Crear sesión
|--------------------------------------------------------------------------
*/

$usuario_id = $stmt->insert_id;

$_SESSION["usuario_id"] = $usuario_id;

$_SESSION["nombre"] = $nombre;

$_SESSION["usuario"] = $usuario;

$_SESSION["correo"] = $correo;


/*
|--------------------------------------------------------------------------
| Ir al inicio
|--------------------------------------------------------------------------
*/

header("Location: ../usuario/inicio.php");

exit;