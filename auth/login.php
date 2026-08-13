<?php

session_start();

if (isset($_SESSION['usuario_id'])) {

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

    <title>Iniciar sesión | Conekta</title>

    <link
        rel="stylesheet"
        href="../assets/css/auth.css"
    >

</head>

<body>

<div class="auth-container">

    <div class="auth-card">

        <div class="auth-logo">
            CONEKTA
        </div>

        <p class="auth-subtitle">
            Conecta. Comparte. Descubre.
        </p>


        <?php if (isset($_GET["registro"])): ?>

            <div class="mensaje exito">
                ¡Cuenta creada correctamente!
                Ahora puedes iniciar sesión.
            </div>

        <?php endif; ?>


        <?php if (isset($_GET["error"])): ?>

            <div class="mensaje error">

                <?php
                echo htmlspecialchars(
                    $_GET["error"]
                );
                ?>

            </div>

        <?php endif; ?>


        <form
            action="validar.php"
            method="POST"
        >

            <input
                type="hidden"
                name="accion"
                value="login"
            >


            <div class="campo">

                <label>
                    Correo electrónico
                </label>

                <input
                    type="email"
                    name="correo"
                    placeholder="correo@ejemplo.com"
                    required
                >

            </div>


            <div class="campo">

                <label>
                    Contraseña
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Tu contraseña"
                    required
                >

            </div>


            <div class="forgot">

                <a href="recuperar.php">
                    ¿Olvidaste tu contraseña?
                </a>

            </div>


            <button
                type="submit"
                class="btn-auth"
            >
                Iniciar sesión
            </button>

        </form>


        <div class="separador">
            <span>o</span>
        </div>


        <div class="auth-link">

            ¿No tienes una cuenta?

            <a href="registro.php">
                Crear cuenta
            </a>

        </div>

    </div>

</div>

</body>

</html>