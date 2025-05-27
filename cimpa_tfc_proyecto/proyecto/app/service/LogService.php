<?php
require_once BASE_PATH . '/app/model/Log.php';
require_once BASE_PATH . '/app/repository/LogRepository.php';

class LogService
{
    private LogRepository $logRepo;

    public function __construct(LogRepository $logRepo)
    {
        $this->logRepo = $logRepo;
    }

    // Inserta un nuevo registro de log
    public function insertLog(string $ip, int $resultType, ?int $userId = null): void
    {
        $log = new Log($ip, $resultType, $userId);
        $this->logRepo->save($log);
    }

    // Obtiene todos los registros de log detallados
    public function getAllLogs(): array
    {
        return $this->logRepo->getAll();
    }
}
