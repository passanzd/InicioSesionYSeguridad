<?php

$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
unset($_SESSION['error']); // Elimina el error después de mostrarlo
$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
unset($_SESSION['success']); // Elimina el error después de mostrarlo
?>
<div class="login-container register">
    <img src="IMG/logo.png" alt="CIMPA Logo" class="logo">
    <?php if (isset($success)): ?>
        <div class="alert register-alert alert-success"> <?= htmlspecialchars($success) ?> </div>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <div class="alert register-alert alert-danger"> <?= htmlspecialchars($error) ?> </div>
    <?php endif; ?>


    <form id="loginForm" action="index.php?action=register" method="POST">
        <div class="form-grid">
            <div class="input-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" placeholder="Nombre" required>
            </div>
            <div class="input-group">
                <label for="surname">Apellido:</label>
                <input type="text" id="surname" name="surname" placeholder="Apellido" required>
            </div>
            <div class="input-group">
                <label for="phone">Teléfono:</label>
                <input type="tel" id="phone" name="phone" placeholder="Ej: 600123456" required>
            </div>
            <div class="input-group">
                <label for="address">Dirección:</label>
                <input type="text" id="address" name="address" placeholder="Dirección" required>
            </div>
        </div>

        <div class="input-group">
            <label for="mail">Correo:</label>
            <input type="email" id="mail" name="mail" placeholder="Ingresa tu correo" required>
        </div>
        <div class="input-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
        </div>
        <div class="input-group">
            <label for="password1">Repite la contraseña:</label>
            <input type="password" id="password1" name="confirmar_password" placeholder="Repite la contraseña" required>
        </div>



        <button type="submit" class="btn">Enviar</button>
    </form>
    <a href="index.php?action=login" class="forgot-pass">Volver al inicio</a>


</div>