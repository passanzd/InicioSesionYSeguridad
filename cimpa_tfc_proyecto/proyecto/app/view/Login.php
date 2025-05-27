<?php


$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
unset($_SESSION['error']); // Elimina el error después de mostrarlo
$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
unset($_SESSION['success']); // Elimina el error después de mostrarlo
?>
<div class="login-container">
    <img src="IMG/logo.png" alt="CIMPA Logo" class="logo">
    <h2>Inicio de sesión</h2>
    <form id="loginForm" action="index.php?action=login" method="POST">

        <div class="input-group">
            <label for="nombre">Correo:</label>
            <input type="email" id="mail" name="mail" placeholder="Ingresa tu correo" required>
        </div>
        <div class="input-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
        </div>
        <?php if (isset($success)): ?>
            <div class="alert alert-success"> <?= htmlspecialchars($success) ?> </div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"> <?= htmlspecialchars($error) ?> </div>
        <?php endif; ?>
        <button type="submit" class="btn">Entrar</button>
    </form>
    <a href="index.php?action=recover_password" class="forgot-pass">¿Olvidaste tu contraseña?</a>
    <a href="index.php?action=register" class="forgot-pass">¿No tienes cuenta? Regístrate aquí</a>

</div>