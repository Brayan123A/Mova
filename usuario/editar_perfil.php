
<?php

session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../auth/login.php");
    exit;
}

$nombre = $_SESSION["nombre"] ?? "Usuario";
$usuario = $_SESSION["usuario"] ?? "usuario";
$correo = $_SESSION["correo"] ?? "";

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Editar perfil | MOVA</title>

    <link
        rel="stylesheet"
        href="../assets/css/usuario.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/editar-perfil.css"
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

        <a href="perfil.php" class="mini-profile">

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


<main class="edit-container">


    <div class="edit-card">

        <div class="edit-header">

            <a href="perfil.php">
                ← Volver
            </a>

            <h1>
                Editar perfil
            </h1>

            <p>
                Personaliza la información que
                compartes en MOVA.
            </p>

        </div>


        <form
            action="#"
            method="POST"
            enctype="multipart/form-data"
        >


            <div class="edit-avatar-section">

                <div class="edit-avatar">

                    <?php
                    echo strtoupper(
                        substr($nombre, 0, 1)
                    );
                    ?>

                </div>

                <div>

                    <strong>
                        Foto de perfil
                    </strong>

                    <p>
                        JPG, PNG o WEBP
                    </p>

                    <label class="photo-button">

                        Cambiar foto

                        <input
                            type="file"
                            name="foto"
                            accept="image/*"
                            hidden
                        >

                    </label>

                </div>

            </div>


            <div class="edit-field">

                <label>
                    Nombre
                </label>

                <input
                    type="text"
                    name="nombre"
                    value="<?php
                        echo htmlspecialchars($nombre);
                    ?>"
                    maxlength="100"
                    required
                >

            </div>


            <div class="edit-field">

                <label>
                    Nombre de usuario
                </label>

                <input
                    type="text"
                    name="usuario"
                    value="<?php
                        echo htmlspecialchars($usuario);
                    ?>"
                    maxlength="50"
                    required
                >

                <small>
                    Tu nombre de usuario aparecerá
                    como @usuario.
                </small>

            </div>


            <div class="edit-field">

                <label>
                    Correo electrónico
                </label>

                <input
                    type="email"
                    name="correo"
                    value="<?php
                        echo htmlspecialchars($correo);
                    ?>"
                    maxlength="150"
                    required
                >

            </div>


            <div class="edit-field">

                <label>
                    Biografía
                </label>

                <textarea
                    name="biografia"
                    maxlength="250"
                    placeholder="Cuéntanos algo sobre ti..."
                ></textarea>

                <small>
                    Máximo 250 caracteres.
                </small>

            </div>


            <div class="edit-actions">

                <a
                    href="perfil.php"
                    class="cancel-button"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="save-button"
                >
                    Guardar cambios
                </button>

            </div>

        </form>

    </div>

</main>

</body>

</html>

