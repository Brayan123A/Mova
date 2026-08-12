
<?php

session_start();

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
| Datos del usuario
|--------------------------------------------------------------------------
*/

$nombre = $_SESSION["nombre"] ?? "Usuario";

$usuario = $_SESSION["usuario"] ?? "usuario";

$inicial = strtoupper(
    substr($nombre, 0, 1)
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Inicio | MOVA</title>

    <link
        rel="stylesheet"
        href="../assets/css/usuario.css"
    >

</head>

<body>


<!-- =====================================================
     BARRA SUPERIOR
===================================================== -->

<header class="topbar">

    <div class="topbar-left">

        <a
            href="inicio.php"
            class="mova-logo"
        >
            <span>M</span>OVA
        </a>

    </div>


    <div class="topbar-search">

        <span>⌕</span>

        <input
            type="text"
            placeholder="Buscar en MOVA..."
        >

    </div>


    <div class="topbar-actions">

        <button
            type="button"
            class="top-icon"
            title="Notificaciones"
        >
            ♡
        </button>

        <button
            type="button"
            class="top-icon"
            title="Mensajes"
        >
            ◌
        </button>


        <a
            href="perfil.php"
            class="mini-profile"
        >

            <span>
                <?php echo htmlspecialchars($inicial); ?>
            </span>

        </a>

    </div>

</header>


<!-- =====================================================
     ESTRUCTURA PRINCIPAL
===================================================== -->

<div class="app-layout">


    <!-- =================================================
         SIDEBAR
    ================================================== -->

    <aside class="sidebar">


        <div class="sidebar-user">

            <div class="avatar-large">

                <?php
                echo htmlspecialchars($inicial);
                ?>

            </div>


            <div>

                <strong>
                    <?php
                    echo htmlspecialchars($nombre);
                    ?>
                </strong>

                <span>
                    @<?php
                    echo htmlspecialchars($usuario);
                    ?>
                </span>

            </div>

        </div>


        <nav class="main-nav">

            <a
                href="inicio.php"
                class="nav-item active"
            >

                <span class="nav-icon">
                    ◉
                </span>

                <span>
                    Inicio
                </span>

            </a>


            <a
                href="../busqueda/index.php"
                class="nav-item"
            >

                <span class="nav-icon">
                    ⌕
                </span>

                <span>
                    Explorar
                </span>

            </a>


            <a
                href="../notificaciones/index.php"
                class="nav-item"
            >

                <span class="nav-icon">
                    ♡
                </span>

                <span>
                    Actividad
                </span>

            </a>


            <a
                href="../mensajes/index.php"
                class="nav-item"
            >

                <span class="nav-icon">
                    ◌
                </span>

                <span>
                    Mensajes
                </span>

            </a>


            <a
                href="../comunidades/index.php"
                class="nav-item"
            >

                <span class="nav-icon">
                    ♧
                </span>

                <span>
                    Comunidades
                </span>

            </a>


            <a
                href="../eventos/index.php"
                class="nav-item"
            >

                <span class="nav-icon">
                    ◫
                </span>

                <span>
                    Eventos
                </span>

            </a>

        </nav>


        <div class="sidebar-bottom">

            <a
                href="perfil.php"
                class="nav-item"
            >

                <span class="nav-icon">
                    ◉
                </span>

                <span>
                    Mi perfil
                </span>

            </a>


            <a
                href="configuracion.php"
                class="nav-item"
            >

                <span class="nav-icon">
                    ⚙
                </span>

                <span>
                    Configuración
                </span>

            </a>


            <a
                href="../auth/cerrar_sesion.php"
                class="logout"
            >

                <span>
                    ↪
                </span>

                Cerrar sesión

            </a>

        </div>

    </aside>


    <!-- =================================================
         CONTENIDO
    ================================================== -->

    <main class="main-content">


        <!-- SALUDO -->

        <section class="welcome-section">

            <div>

                <span class="welcome-label">
                    TU ESPACIO EN MOVA
                </span>

                <h1>

                    Hola,
                    <span>
                        <?php
                        echo htmlspecialchars($nombre);
                        ?>
                    </span>

                </h1>

                <p>
                    ¿Qué quieres compartir hoy?
                </p>

            </div>


            <button
                class="create-button"
                type="button"
            >

                <span>＋</span>

                Crear publicación

            </button>

        </section>


        <!-- CREAR PUBLICACIÓN -->

        <section class="composer">

            <div class="composer-avatar">
                <?php
                echo htmlspecialchars($inicial);
                ?>
            </div>


            <div class="composer-content">

                <button
                    type="button"
                    class="composer-input"
                >
                    Comparte una idea, una foto o algo que
                    quieras contar...
                </button>


                <div class="composer-actions">

                    <button type="button">
                        ◉ Foto
                    </button>

                    <button type="button">
                        ◫ Evento
                    </button>

                    <button type="button">
                        ◎ Encuesta
                    </button>

                    <button
                        type="button"
                        class="publish-button"
                    >
                        Publicar
                    </button>

                </div>

            </div>

        </section>


        <!-- FILTROS -->

        <div class="feed-header">

            <div>

                <strong>
                    Para ti
                </strong>

                <span>
                    Tu actividad
                </span>

            </div>

            <button type="button">
                Más recientes
                ↓
            </button>

        </div>


        <!-- PUBLICACIÓN DE EJEMPLO -->

        <article class="post-card">


            <div class="post-header">

                <div class="post-user">

                    <div class="post-avatar">
                        A
                    </div>

                    <div>

                        <strong>
                            Ana López
                        </strong>

                        <span>
                            @analopez · Hace 12 min
                        </span>

                    </div>

                </div>


                <button
                    class="post-more"
                    type="button"
                >
                    •••
                </button>

            </div>


            <div class="post-content">

                <p>

                    Hoy descubrí un lugar increíble
                    para desconectarme un rato.
                    🌿

                </p>

                <div class="post-placeholder">

                    <span>
                        ✦
                    </span>

                    <p>
                        Contenido multimedia
                    </p>

                </div>

            </div>


            <div class="post-stats">

                <span>
                    ♡ 24
                </span>

                <span>
                    8 comentarios
                </span>

                <span>
                    3 compartidos
                </span>

            </div>


            <div class="post-actions">

                <button type="button">
                    ♡ Me gusta
                </button>

                <button type="button">
                    ◌ Comentar
                </button>

                <button type="button">
                    ↗ Compartir
                </button>

            </div>


        </article>


        <!-- SEGUNDA PUBLICACIÓN -->

        <article class="post-card">


            <div class="post-header">

                <div class="post-user">

                    <div class="post-avatar second">
                        M
                    </div>

                    <div>

                        <strong>
                            Mateo Ruiz
                        </strong>

                        <span>
                            @mateoruiz · Hace 34 min
                        </span>

                    </div>

                </div>


                <button
                    class="post-more"
                    type="button"
                >
                    •••
                </button>

            </div>


            <div class="post-content">

                <p>

                    Una pequeña meta para esta semana:
                    terminar ese proyecto que llevo
                    meses posponiendo. 🚀

                </p>

            </div>


            <div class="post-stats">

                <span>
                    ♡ 41
                </span>

                <span>
                    12 comentarios
                </span>

            </div>


            <div class="post-actions">

                <button type="button">
                    ♡ Me gusta
                </button>

                <button type="button">
                    ◌ Comentar
                </button>

                <button type="button">
                    ↗ Compartir
                </button>

            </div>

        </article>


    </main>


    <!-- =================================================
         PANEL DERECHO
    ================================================== -->

    <aside class="right-panel">


        <div class="panel-card">

            <div class="panel-title">

                <strong>
                    Descubre
                </strong>

                <a href="#">
                    Ver todo
                </a>

            </div>


            <div class="discover-item">

                <div class="discover-avatar purple">
                    L
                </div>

                <div>

                    <strong>
                        Laura Méndez
                    </strong>

                    <span>
                        8 amigos en común
                    </span>

                </div>

                <button>
                    +
                </button>

            </div>


            <div class="discover-item">

                <div class="discover-avatar blue">
                    D
                </div>

                <div>

                    <strong>
                        Diego Torres
                    </strong>

                    <span>
                        4 amigos en común
                    </span>

                </div>

                <button>
                    +
                </button>

            </div>


            <div class="discover-item">

                <div class="discover-avatar orange">
                    S
                </div>

                <div>

                    <strong>
                        Sofía García
                    </strong>

                    <span>
                        6 amigos en común
                    </span>

                </div>

                <button>
                    +
                </button>

            </div>

        </div>


        <div class="panel-card">

            <div class="panel-title">

                <strong>
                    Tendencias
                </strong>

            </div>


            <div class="trend">

                <span>
                    #MOVA
                </span>

                <strong>
                    2.4K publicaciones
                </strong>

            </div>


            <div class="trend">

                <span>
                    #Tecnología
                </span>

                <strong>
                    1.8K publicaciones
                </strong>

            </div>


            <div class="trend">

                <span>
                    #Viajes
                </span>

                <strong>
                    956 publicaciones
                </strong>

            </div>

        </div>


        <footer class="app-footer">

            © <?php echo date("Y"); ?> MOVA

            <span>
                · Privacidad · Ayuda
            </span>

        </footer>

    </aside>

</div>


</body>

</html>

