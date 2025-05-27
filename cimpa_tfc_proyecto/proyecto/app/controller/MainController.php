<?php
require_once BASE_PATH . '/config/Database.php';
require_once BASE_PATH . '/app/repository/UserRepository.php';
require_once BASE_PATH . '/app/repository/LogRepository.php';
require_once BASE_PATH . '/app/repository/IPBlockerRepository.php';
require_once BASE_PATH . '/app/service/AuthService.php';
require_once BASE_PATH . '/app/service/UserService.php';
require_once BASE_PATH . '/app/service/IPBlockerService.php';
require_once BASE_PATH . '/app/service/LogService.php';
require_once BASE_PATH . '/app/controller/UserController.php';

class MainController
{
    // Controlador principal
    public function actions()
    {
        $action = $_GET['action'] ?? 'login';

        $pdo = Database::getInstance();

        $userRepo = new UserRepository($pdo);
        $logRepo = new LogRepository($pdo);
        $ipRepo = new IPBlockerRepository($pdo, $logRepo);

        $authService = new AuthService($userRepo);
        $userService = new UserService($userRepo);
        $logService = new LogService($logRepo);
        $ipService = new IPBlockerService($ipRepo);

        $controller = new UserController($authService, $userService, $ipService, $logService);

        switch ($action) {
            case 'login':
                $this->renderView('Login');
                $controller->login();
                break;

            case 'recover_password':
                $this->renderView('RecoverPassword');
                $controller->sendRecoveryCode();
                break;

            case 'reset_password':
                $this->renderView('ResetPassword');
                $controller->resetPasswordProcess();
                break;

            case 'register':
                $this->renderView('Register');
                $controller->register();
                break;

            case 'verify2fa':
                $this->renderView('MultifactorVerify');
                if (isset($_GET['context']) && $_GET['context'] === 'recovery') {
                    $controller->verifyRecoveryCode();
                } else {
                    $controller->verify2FA();
                }
                break;

            case 'dashboard_user':
                $this->renderView('DashboardUser');
                break;

            case 'dashboard_admin':
                $usuarios = $controller->getNonAdminUsers();
                $this->renderView('DashboardAdmin', ['usuarios' => $usuarios]);
                break;

            case 'logs':
                $logs = $logService->getAllLogs();
                $this->renderView('LogView', ['logs' => $logs]);
                break;

            case 'edit_user':
                $controller->editUser();
                break;

            case 'delete_user':
                $controller->deleteUser();
                break;

            case 'change_state':
                $controller->changeUserState();
                break;

            default:
                $this->renderView('404');
                break;
        }
    }

    // Carga las vistas
    public function renderView($view, $data = [])
    {
        extract($data);
        $viewPath = BASE_PATH . "/app/view/$view.php";
        $currentView = $view;

        require_once BASE_PATH . "/includes/Head.php";
        require_once BASE_PATH . "/includes/Header.php";

        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "<h2>Página no encontrada</h2>";
        }

        require_once BASE_PATH . "/includes/Footer.php";
    }
}
