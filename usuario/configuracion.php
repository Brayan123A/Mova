
<?php

session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../auth/login.php");
    exit;
}

$nombre = $_SESSION["nombre"] ?? "Usuario";

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Configuración | MOVA</title>

    <link
        rel="stylesheet"
        href="../assets/css/usuario.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/configuracion.css"
    >

</head>

<body>

<header class="topbar">

    <div class="topbar-left">

        <a href="inicio.php" class="mova-logo">
            <span>M</span>OVA
        </a>

    </div>


    <div class="topbar-actions">

        <a
            href="perfil.php"
            class="mini-profile"
        >

            <span>
                <?php
                echo strtoupper(
                    substr($nombre, 0, 1)
                );
                ?>
            </span>

        </a>

    </div>

</header>


<main class="settings-container">


    <div class="settings-header">

        <a href="inicio.php">
            ← Volver
        </a>

        <h1>
            Configuración
        </h1>

        <p>
            Controla cómo funciona tu experiencia
            dentro de MOVA.
        </p>

    </div>


    <div class="settings-layout">


        <aside class="settings-menu">

            <button class="settings-menu-item active">
                ⚙ General
            </button>

            <button class="settings-menu-item">
                🔔 Notificaciones
            </button>

            <button class="settings-menu-item">
                🔒 Privacidad
            </button>

            <button class="settings-menu-item">
                🛡 Seguridad
            </button>

            <button class="settings-menu-item">
                🎨 Apariencia
            </button>

        </aside>


        <section class="settings-content">


            <div class="settings-section">

                <h2>
                    General
                </h2>

                <p>
                    Configuración básica de tu cuenta.
                </p>


                <div class="setting-row">

                    <div>

                        <strong>
                            Estado de actividad
                        </strong>

                        <span>
                            Permitir que otros sepan
                            cuándo estás activo.
                        </span>

                    </div>

                    <label class="switch">

                        <input
                            type="checkbox"
                            checked
                        >

                        <span></span>

                    </label>

                </div>


                <div class="setting-row">

                    <div>

                        <strong>
                            Reproducción automática
                        </strong>

                        <span>
                            Reproducir automáticamente
                            contenido multimedia.
                        </span>

                    </div>

                    <label class="switch">

                        <input
                            type="checkbox"
                            checked
                        >

                        <span></span>

                    </label>

                </div>

            </div>


            <div class="settings-section">

                <h2>
                    Apariencia
                </h2>

                <p>
                    Elige cómo quieres visualizar MOVA.
                </p>


                <div class="theme-options">

                    <button
                        type="button"
                        class="theme-option active"
                        onclick="setTheme('light')"
                    >

                        <span>
                            ☀️
                        </span>

                        <strong>
                            Claro
                        </strong>

                    </button>


                    <button
                        type="button"
                        class="theme-option"
                        onclick="setTheme('dark')"
                    >

                        <span>
                            🌙
                        </span>

                        <strong>
                            Oscuro
                        </strong>

                    </button>

                </div>

            </div>


            <div class="settings-section danger-zone">

                <h2>
                    Cuenta
                </h2>

                <p>
                    Acciones relacionadas con tu cuenta.
                </p>


                <a
                    href="../auth/cerrar_sesion.php"
                    class="logout-button"
                >
                    Cerrar sesión
                </a>

            </div>


        </section>

    </div>

</main>


<script>

function setTheme(theme) {

    if (theme === "dark") {

        document.body.classList.add("dark-mode");

        localStorage.setItem(
            "mova-theme",
            "dark"
        );

    } else {

        document.body.classList.remove("dark-mode");

        localStorage.setItem(
            "mova-theme",
            "light"
        );

    }

}

const savedTheme =
    localStorage.getItem("mova-theme");

if (savedTheme === "dark") {

    document.body.classList.add("dark-mode");

}

</script>

</body>

</html>

