<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIMPA</title>
    <link rel="stylesheet" href="<?= asset('public/CSS/styles.css') ?>">

    <?php if (isset($currentView)): ?>
        <?php if (in_array($currentView, ['Login', 'Register', 'RecoverPassword', 'ResetPassword', 'MultifactorVerify'])): ?>
            <link rel="stylesheet" href="<?= asset('public/CSS/auth.css') ?>">
        <?php elseif ($currentView === 'DashboardUser'): ?>
            <link rel="stylesheet" href="<?= asset('public/CSS/user.css') ?>">
        <?php elseif (in_array($currentView, ['DashboardAdmin', 'LogView'])): ?>
            <link rel="stylesheet" href="<?= asset('public/CSS/admin.css') ?>">
        <?php endif; ?>
    <?php endif; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>