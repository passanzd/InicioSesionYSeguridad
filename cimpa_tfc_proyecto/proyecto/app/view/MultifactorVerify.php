<?php
$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
unset($_SESSION['error']);
$isRecovery = isset($_GET['context']) && $_GET['context'] === 'recovery';
?>
<div class="login-container">
    <img src="IMG/logo.png" alt="CIMPA Logo" class="logo">

    <h2><?= $isRecovery ? 'Verificación para recuperar contraseña' : 'Verificación 2FA' ?></h2>

    <form action="index.php?action=verify2fa<?= $isRecovery ? '&context=recovery' : '' ?>" method="POST">
        <div class="input-group">
            <label for="codigo_2fa">Código de verificación:</label>
            <input type="text" id="codigo_2fa" name="codigo_2fa" placeholder="Introduce tu código" required>
        </div>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <button type="submit" class="btn">Verificar</button>
    </form>
</div>