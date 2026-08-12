
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

    <title>Iniciar sesión | MOVA</title>

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
            Vuelve a tu espacio en MOVA.
        </p>

        <?php if (isset($_GET["error"])): ?>

            <div class="auth-message error">

                <?php

                switch ($_GET["error"]) {

                    case "campos":
                        echo "Completa todos los campos.";
                        break;

                    case "credenciales":
                        echo "El correo o la contraseña son incorrectos.";
                        break;

                    case "bloqueado":
                        echo "Esta cuenta se encuentra bloqueada.";
                        break;

                    default:
                        echo "Ocurrió un error. Inténtalo nuevamente.";
                }

                ?>

            </div>

        <?php endif; ?>


        <?php if (isset($_GET["registro"]) && $_GET["registro"] === "ok"): ?>

            <div class="auth-message success">
                ¡Cuenta creada correctamente! Ahora puedes iniciar sesión.
            </div>

        <?php endif; ?>


        <form
            action="validar_login.php"
            method="POST"
        >

            <input
                type="email"
                name="correo"
                placeholder="Correo electrónico"
                autocomplete="email"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Contraseña"
                autocomplete="current-password"
                required
            >

            <button type="submit">
                Entrar a MOVA
            </button>

        </form>


        <p class="link-text">

            ¿No tienes una cuenta?

            <a href="registro.php">
                Crear cuenta
            </a>

        </p>

    </div>

</div>


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
</body>

</html>

