
<?php

session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../auth/login.php");
    exit;
}

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

    <title>Crear publicación | MOVA</title>

    <link
        rel="stylesheet"
        href="../assets/css/usuario.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/crear-publicacion.css"
    >

</head>

<body>


<!-- =====================================================
     TOPBAR
===================================================== -->

<header class="topbar">

    <div class="topbar-left">

        <a
            href="../usuario/inicio.php"
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

        <a
            href="../usuario/perfil.php"
            class="mini-profile"
        >

            <span>
                <?php
                echo htmlspecialchars($inicial);
                ?>
            </span>

        </a>

    </div>

</header>


<!-- =====================================================
     CONTENIDO
===================================================== -->

<main class="create-page">


    <div class="create-card">


        <!-- HEADER -->

        <div class="create-header">

            <a
                href="../usuario/inicio.php"
                class="back-link"
            >
                ← Volver
            </a>


            <div>

                <span class="create-label">
                    NUEVO CONTENIDO
                </span>

                <h1>
                    Crear publicación
                </h1>

                <p>
                    Comparte algo con las personas
                    de tu comunidad.
                </p>

            </div>

        </div>


        <!-- USUARIO -->

        <div class="creator">

            <div class="creator-avatar">

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


        <!-- TIPO DE PUBLICACIÓN -->

        <div class="publication-types">

            <button
                type="button"
                class="type-button active"
                data-type="texto"
                onclick="changeType('texto', this)"
            >

                <span>
                    ✎
                </span>

                Texto

            </button>


            <button
                type="button"
                class="type-button"
                data-type="imagen"
                onclick="changeType('imagen', this)"
            >

                <span>
                    ◉
                </span>

                Imagen

            </button>


            <button
                type="button"
                class="type-button"
                data-type="evento"
                onclick="changeType('evento', this)"
            >

                <span>
                    ◫
                </span>

                Evento

            </button>


            <button
                type="button"
                class="type-button"
                data-type="encuesta"
                onclick="changeType('encuesta', this)"
            >

                <span>
                    ◎
                </span>

                Encuesta

            </button>

        </div>


        <!-- FORMULARIO -->

        <form
            action="guardar.php"
            method="POST"
            enctype="multipart/form-data"
            id="publicationForm"
        >


            <input
                type="hidden"
                name="tipo"
                id="tipo"
                value="texto"
            >


            <!-- TEXTO -->

            <section
                class="publication-section"
                id="sectionTexto"
            >

                <label
                    for="contenido"
                    class="section-title"
                >
                    ¿Qué quieres compartir?
                </label>


                <textarea
                    name="contenido"
                    id="contenido"
                    maxlength="2000"
                    placeholder="Escribe algo que quieras compartir..."
                ></textarea>


                <div class="character-count">

                    <span id="counter">
                        0
                    </span>

                    / 2000

                </div>

            </section>


            <!-- IMAGEN -->

            <section
                class="publication-section hidden"
                id="sectionImagen"
            >

                <label class="section-title">
                    Agrega una imagen
                </label>


                <label
                    for="imagen"
                    class="image-upload"
                >

                    <span class="upload-icon">
                        ＋
                    </span>

                    <strong>
                        Seleccionar imagen
                    </strong>

                    <small>
                        JPG, PNG o WEBP · Máximo 5 MB
                    </small>


                    <input
                        type="file"
                        name="imagen"
                        id="imagen"
                        accept="image/jpeg,image/png,image/webp"
                        hidden
                    >

                </label>


                <div
                    id="imagePreview"
                    class="image-preview"
                ></div>

            </section>


            <!-- EVENTO -->

            <section
                class="publication-section hidden"
                id="sectionEvento"
            >

                <label class="section-title">
                    Información del evento
                </label>


                <div class="event-grid">

                    <div class="field">

                        <label>
                            Nombre del evento
                        </label>

                        <input
                            type="text"
                            name="evento_nombre"
                            placeholder="Ej. Reunión de comunidad"
                        >

                    </div>


                    <div class="field">

                        <label>
                            Fecha
                        </label>

                        <input
                            type="date"
                            name="evento_fecha"
                        >

                    </div>


                    <div class="field">

                        <label>
                            Hora
                        </label>

                        <input
                            type="time"
                            name="evento_hora"
                        >

                    </div>


                    <div class="field">

                        <label>
                            Lugar
                        </label>

                        <input
                            type="text"
                            name="evento_lugar"
                            placeholder="Lugar del evento"
                        >

                    </div>

                </div>


                <textarea
                    name="evento_descripcion"
                    placeholder="Describe el evento..."
                    maxlength="1000"
                ></textarea>

            </section>


            <!-- ENCUESTA -->

            <section
                class="publication-section hidden"
                id="sectionEncuesta"
            >

                <label class="section-title">
                    Crea una encuesta
                </label>


                <textarea
                    name="encuesta_pregunta"
                    placeholder="Escribe tu pregunta..."
                    maxlength="500"
                ></textarea>


                <div class="poll-options">

                    <input
                        type="text"
                        name="opcion_1"
                        placeholder="Opción 1"
                    >

                    <input
                        type="text"
                        name="opcion_2"
                        placeholder="Opción 2"
                    >

                    <input
                        type="text"
                        name="opcion_3"
                        placeholder="Opción 3 (opcional)"
                    >

                    <input
                        type="text"
                        name="opcion_4"
                        placeholder="Opción 4 (opcional)"
                    >

                </div>

            </section>


            <!-- VISIBILIDAD -->

            <div class="visibility">

                <div>

                    <span class="visibility-icon">
                        ◉
                    </span>

                    <div>

                        <strong>
                            Público
                        </strong>

                        <small>
                            Cualquier persona en MOVA
                            podrá ver esta publicación.
                        </small>

                    </div>

                </div>


                <select name="visibilidad">

                    <option value="publico">
                        Público
                    </option>

                    <option value="conexiones">
                        Solo conexiones
                    </option>

                </select>

            </div>


            <!-- BOTONES -->

            <div class="form-actions">

                <a
                    href="../usuario/inicio.php"
                    class="cancel-button"
                >
                    Cancelar
                </a>


                <button
                    type="submit"
                    class="publish-button"
                >
                    Publicar en MOVA
                </button>

            </div>


        </form>

    </div>

</main>


<script>

/*
|--------------------------------------------------------------------------
| Cambiar tipo de publicación
|--------------------------------------------------------------------------
*/

function changeType(type, button) {

    document
        .querySelectorAll(".type-button")
        .forEach(function(btn) {

            btn.classList.remove("active");

        });


    button.classList.add("active");


    document
        .querySelector("#tipo")
        .value = type;


    document
        .querySelectorAll(".publication-section")
        .forEach(function(section) {

            section.classList.add("hidden");

        });


    if (type === "texto") {

        document
            .querySelector("#sectionTexto")
            .classList.remove("hidden");

    }


    if (type === "imagen") {

        document
            .querySelector("#sectionImagen")
            .classList.remove("hidden");

    }


    if (type === "evento") {

        document
            .querySelector("#sectionEvento")
            .classList.remove("hidden");

    }


    if (type === "encuesta") {

        document
            .querySelector("#sectionEncuesta")
            .classList.remove("hidden");

    }

}


/*
|--------------------------------------------------------------------------
| Contador
|--------------------------------------------------------------------------
*/

const contenido =
    document.querySelector("#contenido");

const counter =
    document.querySelector("#counter");


if (contenido) {

    contenido.addEventListener(
        "input",
        function() {

            counter.textContent =
                contenido.value.length;

        }
    );

}


/*
|--------------------------------------------------------------------------
| Vista previa de imagen
|--------------------------------------------------------------------------
*/

const imagen =
    document.querySelector("#imagen");

const imagePreview =
    document.querySelector("#imagePreview");


if (imagen) {

    imagen.addEventListener(
        "change",
        function() {

            const file =
                imagen.files[0];


            if (!file) {

                imagePreview.innerHTML = "";

                return;

            }


            const reader =
                new FileReader();


            reader.onload =
                function(event) {

                    imagePreview.innerHTML = `
                        <img
                            src="${event.target.result}"
                            alt="Vista previa"
                        >
                    `;

                };


            reader.readAsDataURL(file);

        }
    );

}

</script>


</body>

</html>

