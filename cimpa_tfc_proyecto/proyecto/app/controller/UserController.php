<?php
require_once BASE_PATH . '/app/service/AuthService.php';
require_once BASE_PATH . '/app/service/UserService.php';
require_once BASE_PATH . '/app/util/Mailer.php';
require_once BASE_PATH . '/app/service/LogService.php';
require_once BASE_PATH . '/app/service/IPBlockerService.php';
require_once BASE_PATH . '/app/model/Log.php';

class UserController
{
    private AuthService $authService;
    private UserService $userService;
    private IPBlockerService $ipService;
    private LogService $logService;

    public function __construct(AuthService $authService, UserService $userService, IPBlockerService $ipService, LogService $logService)
    {
        $this->authService = $authService;
        $this->userService = $userService;
        $this->ipService = $ipService;
        $this->logService = $logService;
    }

    // Obtiene los datos de inicio de sesión del formulario
    private function loginData(): array
    {
        return [$_POST['mail'] ?? '', $_POST['password'] ?? ''];
    }

    // Inicia sesión un usuario
    public function login(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            [$mail, $password] = $this->loginData();


            $userTemp = $this->userService->getUserByMail($mail);
            $usuarioId = $userTemp?->getId();
            $ip = $this->ipService->getClientIP();
            $error = $this->ipService->validateAccess($ip, $usuarioId);

            if ($error) {
                $_SESSION['error'] = $error;
                header("Location: /cimpa_tfc_proyecto/proyecto/public/");
                exit;
            }

            $user = $this->authService->verifyUser($mail, $password);

            if (!$user) {
                if ($usuarioId) {

                    $this->logService->insertLog($ip, 5, $usuarioId);
                }

                if ($this->authService->isUserBlocked($mail)) {
                    $_SESSION['error'] = "Tu cuenta ha sido bloqueada temporalmente.";
                    header("Location: /cimpa_tfc_proyecto/proyecto/public/");
                    exit;
                }

                $_SESSION['error'] = "Usuario o contraseña incorrectos.";
                header("Location: /cimpa_tfc_proyecto/proyecto/public/");
                exit;
            }

            $_SESSION["ID_USUARIO"] = $user->getId();
            $_SESSION["NOMBRE"] = $user->getName();
            $_SESSION["APELLIDO"] = $user->getLastName();
            $_SESSION["MAIL"] = $user->getMail();
            $_SESSION["TELEFONO"] = $user->getPhone();
            $_SESSION["DIRECCION"] = $user->getAddress();
            $_SESSION["TIPO_USUARIO"] = $user->getUserType();

            $this->send2FACode($user);
            header("Location: /cimpa_tfc_proyecto/proyecto/public/index.php?action=verify2fa");
            exit;
        }
    }

    // Verifica el código 2FA ingresado por el usuario
    public function verify2FA(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $codigo = $_POST['codigo_2fa'] ?? '';

            if (!isset($_SESSION['2fa_code']) || $codigo != $_SESSION['2fa_code']) {
                $_SESSION['error'] = "Código incorrecto.";
                header("Location: /cimpa_tfc_proyecto/proyecto/public/index.php?action=verify2fa");
                exit;
            }

            $_SESSION['loggedin'] = true;
            unset($_SESSION['2fa_code']);
            $this->redirectByType($_SESSION['TIPO_USUARIO']);
        }
    }

    // Envía un código de recuperación al correo del usuario
    public function sendRecoveryCode(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mail = $_POST['mail'] ?? '';
            $phone = $_POST['telefono'] ?? '';
            $user = $this->userService->getUserByMailAndPhone($mail, $phone);

            if (!$user) {
                $_SESSION['error'] = "Correo o teléfono incorrecto.";
                header("Location: index.php?action=recover_password");
                exit;
            }

            $this->send2FACode($user);
            $_SESSION['recovery_mode'] = true;
            $_SESSION['2fa_mail'] = $user->getMail();
            $_SESSION['nombre_usuario'] = $user->getName();
            $_SESSION['tipo_usuario'] = $user->getUserType();
            $_SESSION['telefono_usuario'] = $user->getPhone();
            $_SESSION['success'] = "Se ha enviado un código de recuperación a tu correo.";

            header("Location: index.php?action=verify2fa&context=recovery");
            exit;
        }
    }

    // Verifica el código de recuperación ingresado por el usuario
    public function verifyRecoveryCode(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo = $_POST['codigo_2fa'] ?? '';

            if (!isset($_SESSION['2fa_code']) || $codigo != $_SESSION['2fa_code']) {
                $_SESSION['error'] = "Código incorrecto.";
                header("Location: index.php?action=verify2fa&context=recovery");
                exit;
            }

            $_SESSION['allow_reset'] = true;
            unset($_SESSION['2fa_code']);
            header("Location: index.php?action=reset_password");
            exit;
        }
    }

    // Procesa el cambio de contraseña del usuario
    public function resetPasswordProcess(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['allow_reset'], $_SESSION['2fa_mail'])) {
                $_SESSION['error'] = "No tienes permiso para cambiar la contraseña.";
                header("Location: /cimpa_tfc_proyecto/proyecto/public/");
                exit;
            }

            $newPassword = $_POST['new_password'];
            $email = $_SESSION['2fa_mail'];
            $user = $this->userService->getUserByMail($email);

            if ($user && $this->userService->resetPassword($user->getId(), $newPassword)) {
                unset($_SESSION['allow_reset'], $_SESSION['2fa_mail'], $_SESSION['nombre_usuario'], $_SESSION['tipo_usuario'], $_SESSION['telefono_usuario']);
                $_SESSION['success'] = "Contraseña actualizada con éxito.";
                header("Location: /cimpa_tfc_proyecto/proyecto/public/");
            } else {
                $_SESSION['error'] = "Error al actualizar la contraseña.";
                header("Location: index.php?action=reset_password");
            }
            exit;
        }
    }

    // Registra un nuevo usuario
    public function register(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            [$name, $surname, $phone, $address, $mail, $password, $confirm] = [
                $_POST['name'],
                $_POST['surname'],
                $_POST['phone'],
                $_POST['address'],
                $_POST['mail'],
                $_POST['password'],
                $_POST['confirmar_password']
            ];

            $valid = $this->userService->validateRegistration($mail, $password, $confirm);
            $error = $this->userService->getError();

            if (!$valid) {
                $_SESSION['error'] = $error;
                header("Location: index.php?action=register");
                exit;
            }

            if ($this->userService->registerUser($name, $surname, $phone, $address, $mail, $password)) {
                $_SESSION['success'] = "Registro exitoso. Ahora puedes iniciar sesión.";
            } else {
                $_SESSION['error'] = "Error al registrar el usuario.";
            }

            header("Location: index.php?action=register");
            exit;
        }
    }

    // Lanza el correo de verificación para el usuario
    private function send2FACode(User $user): void
    {
        $codigo = random_int(100000, 999999);
        $_SESSION['2fa_code'] = $codigo;
        Mailer::send2FACode($user->getMail(), $user->getName(), $codigo);
    }

    // Redirige al usuario según su tipo (usuario/admin)
    private function redirectByType(string $type): void
    {
        $ruta = $type === 'Administrador' ? 'dashboard_admin' : 'dashboard_user';
        header("Location: /cimpa_tfc_proyecto/proyecto/public/index.php?action=$ruta");
        exit;
    }

    // Obtiene los usuarios no administradores
    public function getNonAdminUsers(): array
    {
        return $this->userService->getNonAdminUsers();
    }

    // Actualiza los datos del usuario
    public function editUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['ID_USUARIO'];
            $mail = $_POST['mail'];
            $address = $_POST['direccion'];
            $phone = $_POST['telefono'];

            if ($this->userService->updateUserData($id, $mail, $address, $phone)) {
                // Actualizamos la sesión
                $_SESSION['NOMBRE'] = $mail;
                $_SESSION['DIRECCION'] = $address;
                $_SESSION['TELEFONO'] = $phone;
                $_SESSION['success'] = "Datos actualizados correctamente.";
            } else {
                $_SESSION['error'] = "No se pudieron actualizar los datos.";
            }

            header("Location: /cimpa_tfc_proyecto/proyecto/public/index.php?action=dashboard_user");
            exit;
        }
    }

    // Elimina la cuenta del usuario
    public function deleteUser(): void
    {
        if (isset($_SESSION['ID_USUARIO'])) {
            $id = $_SESSION['ID_USUARIO'];

            if ($this->userService->deleteUserData($id)) {
                session_unset();
                session_destroy();
                header("Location: /cimpa_tfc_proyecto/proyecto/public/index.php");
            } else {
                $_SESSION['error'] = "No se pudo eliminar la cuenta.";
                header("Location: /cimpa_tfc_proyecto/proyecto/public/index.php?action=dashboard_user");
            }
            exit;
        }
    }

    // Cambia el estado de un usuario (Activado/Bloqueado)
    public function changeUserState(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idUser = $_POST['id_usuario'] ?? null;
            $newState = $_POST['nuevo_estado'] ?? null;

            if ($idUser && in_array($newState, ['Activado', 'Bloqueado'])) {
                $this->userService->editUserState((int)$idUser, $newState);
            }

            header("Location: /cimpa_tfc_proyecto/proyecto/public/index.php?action=dashboard_admin");
            exit;
        }
    }
}
