
<?php

session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../auth/login.php");
    exit;
}

$nombre = $_SESSION["nombre"] ?? "Usuario";
$usuario = $_SESSION["usuario"] ?? "usuario";
$inicial = strtoupper(substr($nombre, 0, 1));

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Mi perfil | MOVA</title>

    <link
        rel="stylesheet"
        href="../assets/css/usuario.css"
      
    >

     <link
        rel="stylesheet"
        href="../assets/css/perfil.css"
      
    >

</head>

<body>

<header class="topbar">

    <div class="topbar-left">

        <a href="inicio.php" class="mova-logo">
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

        <button class="top-icon">
            ♡
        </button>

        <button class="top-icon">
            ◌
        </button>

        <a href="perfil.php" class="mini-profile">
            <span>
                <?php echo htmlspecialchars($inicial); ?>
            </span>
        </a>

    </div>

</header>


<div class="app-layout">


    <aside class="sidebar">

        <div class="sidebar-user">

            <div class="avatar-large">
                <?php echo htmlspecialchars($inicial); ?>
            </div>

            <div>

                <strong>
                    <?php echo htmlspecialchars($nombre); ?>
                </strong>

                <span>
                    @<?php echo htmlspecialchars($usuario); ?>
                </span>

            </div>

        </div>


        <nav class="main-nav">

            <a href="inicio.php" class="nav-item">
                <span class="nav-icon">◉</span>
                Inicio
            </a>

            <a href="../busqueda/index.php" class="nav-item">
                <span class="nav-icon">⌕</span>
                Explorar
            </a>

            <a href="../notificaciones/index.php" class="nav-item">
                <span class="nav-icon">♡</span>
                Actividad
            </a>

            <a href="../mensajes/index.php" class="nav-item">
                <span class="nav-icon">◌</span>
                Mensajes
            </a>

            <a href="../comunidades/index.php" class="nav-item">
                <span class="nav-icon">♧</span>
                Comunidades
            </a>

            <a href="../eventos/index.php" class="nav-item">
                <span class="nav-icon">◫</span>
                Eventos
            </a>

        </nav>


        <div class="sidebar-bottom">

            <a
                href="perfil.php"
                class="nav-item active"
            >
                <span class="nav-icon">◉</span>
                Mi perfil
            </a>

            <a
                href="configuracion.php"
                class="nav-item"
            >
                <span class="nav-icon">⚙</span>
                Configuración
            </a>

            <a
                href="../auth/cerrar_sesion.php"
                class="logout"
            >
                ↪ Cerrar sesión
            </a>

        </div>

    </aside>


    <main class="main-content profile-page">


        <section class="profile-header">

            <div class="profile-cover">

                <div class="profile-avatar">
                    <?php echo htmlspecialchars($inicial); ?>
                </div>

            </div>


            <div class="profile-info">

                <div>

                    <h1>
                        <?php echo htmlspecialchars($nombre); ?>
                    </h1>

                    <p>
                        @<?php echo htmlspecialchars($usuario); ?>
                    </p>

                </div>


                <a
                    href="editar_perfil.php"
                    class="edit-profile-button"
                >
                    Editar perfil
                </a>

            </div>


            <p class="profile-bio">
                Bienvenido a mi espacio en MOVA.
                Aquí comparto ideas, momentos y cosas
                que me interesan.
            </p>


            <div class="profile-stats">

                <div>
                    <strong>0</strong>
                    <span>Publicaciones</span>
                </div>

                <div>
                    <strong>0</strong>
                    <span>Conexiones</span>
                </div>

                <div>
                    <strong>0</strong>
                    <span>Siguiendo</span>
                </div>

            </div>

        </section>


        <div class="profile-tabs">

            <button class="profile-tab active">
                Publicaciones
            </button>

            <button class="profile-tab">
                Multimedia
            </button>

            <button class="profile-tab">
                Actividad
            </button>

        </div>


        <section class="empty-profile">

            <div class="empty-icon">
                ✦
            </div>

            <h2>
                Tu espacio comienza aquí
            </h2>

            <p>
                Cuando publiques algo,
                aparecerá en esta sección.
            </p>

            <a href="inicio.php">
                Crear mi primera publicación
            </a>

        </section>


    </main>

</div>

</body>

</html>

