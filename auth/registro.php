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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crear cuenta | Conekta</title>

    <link rel="stylesheet" href="../assets/css/auth.css">
</head>

<body>

<div class="auth-container">

    <div class="auth-card">

        <div class="auth-logo">
            CONEKTA
        </div>

        <p class="auth-subtitle">
            Crea tu cuenta y comienza a conectar.
        </p>

        <?php if (isset($_GET['error'])): ?>

            <div class="mensaje error">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>

        <?php endif; ?>

        <form action="validar.php" method="POST">

            <input type="hidden" name="accion" value="registro">

            <div class="campo">
                <label>Nombre completo</label>

                <input
                    type="text"
                    name="nombre"
                    placeholder="Tu nombre"
                    maxlength="100"
                    required
                >
            </div>

            <div class="campo">
                <label>Nombre de usuario</label>

                <input
                    type="text"
                    name="usuario"
                    placeholder="@tuusuario"
                    maxlength="50"
                    required
                >
            </div>

            <div class="campo">
                <label>Correo electrónico</label>

                <input
                    type="email"
                    name="correo"
                    placeholder="correo@ejemplo.com"
                    maxlength="150"
                    required
                >
            </div>

            <div class="campo">
                <label>Contraseña</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Mínimo 8 caracteres"
                    minlength="8"
                    required
                >
            </div>

            <div class="campo">
                <label>Confirmar contraseña</label>

                <input
                    type="password"
                    name="confirmar_password"
                    placeholder="Repite tu contraseña"
                    minlength="8"
                    required
                >
            </div>

            <button type="submit" class="btn-auth">
                Crear cuenta
            </button>

        </form>

        <div class="auth-link">
            ¿Ya tienes una cuenta?
            <a href="login.php">Iniciar sesión</a>
        </div>

    </div>

</div>

</body>
</html>