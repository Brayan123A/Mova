<?php

session_start();

if (isset($_SESSION["usuario_id"])) {
    header("Location: ../usuario/inicio.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Crear cuenta | MOVA</title>

    <link
        rel="stylesheet"
        href="../assets/css/auth.css"
    >

</head>

<body>

<div class="auth-container">

    <div class="auth-box">

        <div class="logo">
            <span>M</span>OVA
        </div>

        <p class="subtitle">
            Crea tu cuenta y empieza a conectar.
        </p>

        <form
            action="validar_registro.php"
            method="POST"
        >

            <input
                type="text"
                name="nombre"
                placeholder="Nombre completo"
                maxlength="100"
                required
            >

            <input
                type="text"
                name="usuario"
                placeholder="Nombre de usuario"
                maxlength="50"
                required
            >

            <input
                type="email"
                name="correo"
                placeholder="Correo electrónico"
                maxlength="150"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Contraseña"
                minlength="8"
                required
            >

            <input
                type="password"
                name="confirmar_password"
                placeholder="Confirmar contraseña"
                minlength="8"
                required
            >

            <button type="submit">
                Crear cuenta
            </button>

        </form>

        <p class="link-text">

            ¿Ya tienes una cuenta?

            <a href="login.php">
                Iniciar sesión
            </a>

        </p>

    </div>

</div>

</body>

</html>