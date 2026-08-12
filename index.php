
<?php

session_start();

/*
|--------------------------------------------------------------------------
| Si ya inició sesión, enviarlo directamente a MOVA
|--------------------------------------------------------------------------
*/

if (isset($_SESSION["usuario_id"])) {

    header("Location: usuario/inicio.php");

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

    <meta
        name="description"
        content="MOVA, una nueva forma de conectar, compartir y descubrir."
    >

    <title>MOVA | Conecta a tu manera</title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>

<body>

<!-- =========================================
     NAVEGACIÓN
========================================= -->

<header class="landing-header">

    <a
        href="index.php"
        class="landing-logo"
    >
        <span>M</span>OVA
    </a>


    <nav class="landing-nav">

        <a href="#caracteristicas">
            Características
        </a>

        <a href="#como-funciona">
            ¿Cómo funciona?
        </a>

        <a
            href="auth/login.php"
            class="login-link"
        >
            Iniciar sesión
        </a>

        <a
            href="auth/registro.php"
            class="register-button"
        >
            Crear cuenta
        </a>

    </nav>

    <button
    type="button"
    id="themeToggle"
    class="theme-toggle"
    aria-label="Cambiar tema"
    title="Cambiar tema"
>
    🌙
</button>

</header>


<!-- =========================================
     HERO
========================================= -->

<main>

<section class="hero">

    <div class="hero-content">

        <div class="hero-badge">
            ✦ Una nueva forma de conectar
        </div>


        <h1>

            Comparte.

            <span>
                Conecta.
            </span>

            Descubre.

        </h1>


        <p class="hero-description">

            MOVA es una red social creada para compartir
            momentos, ideas y experiencias con personas
            que realmente quieres tener cerca.

        </p>


        <div class="hero-buttons">

            <a
                href="auth/registro.php"
                class="primary-button"
            >
                Crear mi cuenta
                <span>→</span>
            </a>

            <a
                href="auth/login.php"
                class="secondary-button"
            >
                Ya tengo una cuenta
            </a>

        </div>


        <div class="hero-users">

            <div class="user-stack">

                <span>J</span>
                <span>A</span>
                <span>C</span>
                <span>M</span>

            </div>

            <div>

                <strong>
                    Únete a MOVA
                </strong>

                <small>
                    Comparte tu mundo a tu manera.
                </small>

            </div>

        </div>

    </div>


    <!-- =====================================
         PREVISUALIZACIÓN
    ====================================== -->

    <div class="hero-preview">

        <div class="preview-glow"></div>


        <div class="preview-window">

            <div class="preview-top">

                <strong>
                    MOVA
                </strong>

                <div>
                    ◯ &nbsp; 🔔 &nbsp; ✉
                </div>

            </div>


            <div class="preview-body">

                <aside class="preview-sidebar">

                    <div class="preview-avatar">
                        B
                    </div>

                    <div class="preview-line active"></div>

                    <div class="preview-line"></div>

                    <div class="preview-line"></div>

                    <div class="preview-line"></div>

                    <div class="preview-line"></div>

                </aside>


                <div class="preview-feed">

                    <div class="preview-welcome">

                        <small>
                            TU ESPACIO
                        </small>

                        <h3>
                            ¿Qué está pasando?
                        </h3>

                    </div>


                    <div class="preview-create">

                        <div class="mini-avatar">
                            B
                        </div>

                        <div>
                            Comparte algo con MOVA...
                        </div>

                    </div>


                    <div class="preview-post">

                        <div class="preview-post-user">

                            <div class="mini-avatar purple">
                                A
                            </div>

                            <div>

                                <strong>
                                    Ana López
                                </strong>

                                <small>
                                    hace 8 min
                                </small>

                            </div>

                        </div>


                        <div class="fake-photo">

                            <div>
                                ✦
                            </div>

                        </div>


                        <div class="fake-actions">

                            ♡  &nbsp;&nbsp;
                            ○  &nbsp;&nbsp;
                            ↗

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================
     CARACTERÍSTICAS
========================================= -->

<section
    class="features"
    id="caracteristicas"
>

    <div class="section-heading">

        <span>
            TODO EN UN SOLO LUGAR
        </span>

        <h2>
            Una red social pensada para conectar
        </h2>

        <p>
            MOVA reúne las herramientas que necesitas
            para compartir y descubrir contenido.
        </p>

    </div>


    <div class="feature-grid">

        <article class="feature-card">

            <div class="feature-icon purple">
                ✦
            </div>

            <h3>
                Publicaciones
            </h3>

            <p>
                Comparte fotos, videos, pensamientos,
                encuestas y mucho más.
            </p>

        </article>


        <article class="feature-card">

            <div class="feature-icon blue">
                ◉
            </div>

            <h3>
                Descubre
            </h3>

            <p>
                Encuentra personas y contenido
                que coincidan con tus intereses.
            </p>

        </article>


        <article class="feature-card">

            <div class="feature-icon green">
                💬
            </div>

            <h3>
                Conversaciones
            </h3>

            <p>
                Habla con tus amigos mediante
                mensajes privados y grupos.
            </p>

        </article>


        <article class="feature-card">

            <div class="feature-icon orange">
                ♡
            </div>

            <h3>
                Tu espacio
            </h3>

            <p>
                Personaliza tu perfil y decide
                qué quieres compartir.
            </p>

        </article>

    </div>

</section>


<!-- =========================================
     COMO FUNCIONA
========================================= -->

<section
    class="how-section"
    id="como-funciona"
>

    <div class="how-content">

        <span>
            SIMPLE
        </span>

        <h2>
            Empieza en pocos pasos.
        </h2>

        <p>
            Crea tu cuenta, encuentra personas,
            comparte contenido y comienza a formar
            parte de MOVA.
        </p>

    </div>


    <div class="steps">

        <div class="step">

            <div class="step-number">
                01
            </div>

            <div>

                <h3>
                    Crea tu cuenta
                </h3>

                <p>
                    Regístrate gratuitamente.
                </p>

            </div>

        </div>


        <div class="step">

            <div class="step-number">
                02
            </div>

            <div>

                <h3>
                    Encuentra personas
                </h3>

                <p>
                    Descubre perfiles interesantes.
                </p>

            </div>

        </div>


        <div class="step">

            <div class="step-number">
                03
            </div>

            <div>

                <h3>
                    Comparte
                </h3>

                <p>
                    Publica lo que quieras.
                </p>

            </div>

        </div>

    </div>

</section>


<!-- =========================================
     CTA
========================================= -->

<section class="cta">

    <div>

        <span>
            TU HISTORIA COMIENZA AQUÍ
        </span>

        <h2>
            ¿Listo para entrar a MOVA?
        </h2>

        <p>
            Crea tu cuenta y empieza a conectar.
        </p>

        <a
            href="auth/registro.php"
            class="cta-button"
        >
            Crear cuenta gratis →
        </a>

    </div>

</section>

</main>


<!-- =========================================
     FOOTER
========================================= -->

<footer class="landing-footer">

    <div class="footer-logo">
        <span>M</span>OVA
    </div>

    <p>
        Una nueva forma de conectar.
    </p>

    <span>
        © <?php echo date("Y"); ?> MOVA
    </span>

</footer>


</body>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const themeToggle = document.getElementById("themeToggle");

    const savedTheme = localStorage.getItem("mova-theme");

    if (savedTheme === "dark") {
        document.body.classList.add("dark-mode");
        themeToggle.textContent = "☀️";
    }

    themeToggle.addEventListener("click", function () {

        document.body.classList.toggle("dark-mode");

        const isDark =
            document.body.classList.contains("dark-mode");

        localStorage.setItem(
            "mova-theme",
            isDark ? "dark" : "light"
        );

        themeToggle.textContent =
            isDark ? "☀️" : "🌙";
    });

});
</script>

</html>

