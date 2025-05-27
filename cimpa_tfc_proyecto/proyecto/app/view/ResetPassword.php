<div class="login-container">
    <img src="<?= asset('public/IMG/logo.png') ?>" alt="CIMPA Logo" class="logo">
    <h2>Recuperar contraseña</h2>
    <form id="loginForm" action="<?= asset('public/index.php?action=reset_password') ?>" method="POST">

        <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">
        <div class="input-group">
            <label for="new_password">Nueva contraseña:</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <button type="submit" class="btn">Restablecer</button>
    </form>
    <a href="<?= BASE_URL . '/public/' ?>" class="forgot-pass">Volver al inicio</a>
</div>