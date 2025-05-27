<?php
require_once BASE_PATH . '/config/Database.php';
require_once BASE_PATH . '/app/model/Log.php';
require_once BASE_PATH . '/app/repository/LogRepository.php';

class IPBlockerRepository
{
    private PDO $pdo;
    private LogRepository $logRepo;

    public function __construct(PDO $pdo, LogRepository $logRepo)
    {
        $this->pdo = $pdo;
        $this->logRepo = $logRepo;
    }

    // Obtiene la IP del cliente
    public function getClientIP(): string
    {
        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        //return '8.8.8.8'; // para pruebas
        //return '81.45.23.10';
    }

    // Verifica si la IP está autorizada
    public function isIPAuthorized(string $ip, ?int $userId = null): bool
    {
        $isAuthorized = false;
        try {
            $query = "SELECT 1 FROM ips_autorizadas WHERE ip = :ip";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':ip', $ip);
            $stmt->execute();
            $isAuthorized = (bool) $stmt->fetch();

            $resultType = $isAuthorized ? 1 : 2;
            $log = new Log($ip, $resultType, $userId);
            $this->logRepo->save($log);
        } catch (PDOException $e) {
            error_log("Error in isIPAuthorized: " . $e->getMessage());
        }
        return $isAuthorized;
    }

    // Verifica si la ubicación de la IP está permitida
    public function isLocationAllowed(string $ip, ?int $userId = null): bool
    {
        // Permitir localhost
        if (in_array($ip, ['127.0.0.1', '::1'])) {
            return true;
        }

        $allowed = false;

        $geo = @json_decode(file_get_contents("http://ip-api.com/json/{$ip}?fields=status,countryCode,message"), true);

        if (!$geo || $geo['status'] !== 'success') {
            error_log("Geolocation failed for IP: {$ip}. Message: " . ($geo['message'] ?? 'No message'));
            $log = new Log($ip, 3, $userId); // error
            $this->logRepo->save($log);
        } else {
            $allowed = $geo['countryCode'] === 'ES';

            if (!$allowed) {
                $log = new Log($ip, 4, $userId); // pais no permitido
                $this->logRepo->save($log);
            }
        }

        return $allowed;
    }
}
