<?php


require_once BASE_PATH . '/lib/PHPMailer/PHPMailer.php';
require_once BASE_PATH . '/lib/PHPMailer/SMTP.php';
require_once BASE_PATH . '/lib/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mailer
{

    public static function send2FACode($toEmail, $toName, $codigo)
    {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'seguridadcimpa@gmail.com';
            $mail->Password   = 'rrsp cpqu obio topk';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            // Destinatario
            $mail->setFrom('seguridadcimpa@gmail.com', 'Seguridad Corporativa Cimpa');
            $mail->addAddress($toEmail, $toName);

            // Contenido
            $mail->isHTML(true);
            $mail->Subject = 'Código de verificación 2FA';

            $mail->Body = '
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fa;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .logo {
            max-width: 180px;
            margin-bottom: 20px;
        }
        h2 {
            color: #0a4aa1;
        }
        p {
            font-size: 16px;
            color: #333;
        }
        .code {
            font-size: 24px;
            font-weight: bold;
            color: #0a4aa1;
            background-color: #eef3fc;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin: 20px 0;
        }
        .footer {
            font-size: 13px;
            color: #888;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://i.imgur.com/7H0yEcJ.png" alt="Logo de la empresa" class="logo">
        <h2>Hola, ' . htmlspecialchars($toName) . '</h2>
        <p>Hemos recibido una solicitud de verificación en tu cuenta. Para continuar, introduce el siguiente código:</p>
        <div class="code">' . $codigo . '</div>
        <p>Si no fuiste tú quien solicitó este código, por favor ignora este mensaje o contacta con soporte.</p>
        <div class="footer">
            © ' . date("Y") . ' CIMPA. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>';


            $mail->send();
        } catch (Exception $e) {
            error_log("Error al enviar correo 2FA: {$mail->ErrorInfo}");
            throw new \Exception("No se pudo enviar el correo de verificación.");
        }
    }
}
