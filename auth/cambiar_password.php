<?php

session_start();

require_once "../config/conexion.php";


/*
|--------------------------------------------------------------------------
| Buscar usuario
|--------------------------------------------------------------------------
*/

if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    ($_POST["accion"] ?? "") === "buscar"
) {

    $correo = trim(
        $_POST["correo"] ?? ""
    );


    if (
        $correo === "" ||
        !filter_var(
            $correo,
            FILTER_VALIDATE_EMAIL
        )
    ) {

        header(
            "Location: recuperar.php?error="
            . urlencode("Introduce un correo válido.")
        );

        exit;
    }


    $sql = "
        SELECT id
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


    if (
        mysqli_num_rows($resultado) === 0
    ) {

        mysqli_stmt_close($stmt);

        header(
            "Location: recuperar.php?error="
            . urlencode("No encontramos una cuenta con ese correo.")
        );

        exit;
    }


    $usuario = mysqli_fetch_assoc(
        $resultado
    );


    mysqli_stmt_close($stmt);


    /*
    | Guardamos temporalmente el usuario
    */

    $_SESSION["recuperar_usuario_id"] =
        $usuario["id"];

    $_SESSION["recuperar_correo"] =
        $correo;


    header(
        "Location: cambiar_password.php"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| Mostrar formulario
|--------------------------------------------------------------------------
*/

if (
    $_SERVER["REQUEST_METHOD"] === "GET" &&
    isset($_SESSION["recuperar_usuario_id"])
) {

    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>

        <meta charset="UTF-8">

        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        >

        <title>Nueva contraseña | Conekta</title>

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

            <h2>
                Nueva contraseña
            </h2>

            <p class="auth-subtitle">
                Crea una nueva contraseña para tu cuenta.
            </p>


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
                action="cambiar_password.php"
                method="POST"
            >

                <input
                    type="hidden"
                    name="accion"
                    value="cambiar"
                >


                <div class="campo">

                    <label>
                        Nueva contraseña
                    </label>

                    <input
                        type="password"
                        name="password"
                        minlength="8"
                        required
                    >

                </div>


                <div class="campo">

                    <label>
                        Confirmar contraseña
                    </label>

                    <input
                        type="password"
                        name="confirmar_password"
                        minlength="8"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="btn-auth"
                >
                    Cambiar contraseña
                </button>

            </form>

        </div>

    </div>

    </body>

    </html>

    <?php

    exit;
}


/*
|--------------------------------------------------------------------------
| Cambiar contraseña
|--------------------------------------------------------------------------
*/

if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    ($_POST["accion"] ?? "") === "cambiar"
) {

    if (
        !isset(
            $_SESSION["recuperar_usuario_id"]
        )
    ) {

        header(
            "Location: recuperar.php?error="
            . urlencode("La sesión de recuperación expiró.")
        );

        exit;
    }


    $password =
        $_POST["password"] ?? "";

    $confirmar =
        $_POST["confirmar_password"] ?? "";


    if (strlen($password) < 8) {

        header(
            "Location: cambiar_password.php?error="
            . urlencode("La contraseña debe tener mínimo 8 caracteres.")
        );

        exit;
    }


    if ($password !== $confirmar) {

        header(
            "Location: cambiar_password.php?error="
            . urlencode("Las contraseñas no coinciden.")
        );

        exit;
    }


    $password_hash =
        password_hash(
            $password,
            PASSWORD_DEFAULT
        );


    $id =
        (int) $_SESSION["recuperar_usuario_id"];


    $sql = "
        UPDATE usuarios
        SET password = ?
        WHERE id = ?
    ";


    $stmt = mysqli_prepare(
        $conexion,
        $sql
    );


    mysqli_stmt_bind_param(
        $stmt,
        "si",
        $password_hash,
        $id
    );


    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);


        unset(
            $_SESSION["recuperar_usuario_id"]
        );

        unset(
            $_SESSION["recuperar_correo"]
        );


        header(
            "Location: login.php?mensaje="
            . urlencode("Contraseña actualizada correctamente.")
        );

        exit;

    }


    mysqli_stmt_close($stmt);


    header(
        "Location: cambiar_password.php?error="
        . urlencode("No se pudo actualizar la contraseña.")
    );

    exit;
}


header("Location: login.php");
exit;