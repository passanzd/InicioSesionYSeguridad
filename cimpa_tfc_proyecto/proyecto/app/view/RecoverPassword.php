<div class="login-container">

    <img src="<?= asset('public/IMG/logo.png') ?>" alt="CIMPA Logo" class="logo">
    <h2>Recuperación</h2>
    <form id="loginForm" action="<?= asset('public/index.php?action=recover_password') ?>" method="POST">
        <div class="input-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="mail" name="mail" placeholder="Ingresa tu correo" required>
        </div>
        <div class="input-group">
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" placeholder="Ingresa tu teléfono" required>
        </div>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <button type="submit" class="btn">Enviar código</button>
    </form>
    <a href="<?= BASE_URL . '/public/' ?>" class="forgot-pass">Volver al inicio</a>
</div>