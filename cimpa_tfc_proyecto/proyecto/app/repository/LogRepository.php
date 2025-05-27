<?php
require_once BASE_PATH . '/config/Database.php';

class LogRepository

{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    // Guarda un registro de log en la base de datos
    public function save(Log $log): void
    {
        try {
            $query = "INSERT INTO logs_intentos_ip (ip, tipo_resultado, usuario_id) VALUES (:ip, :tipo, :usuario_id)";
            $stmt = $this->pdo->prepare($query);

            $ip = $log->getIp();
            $tipo = $log->getResultType();
            $usuarioId = $log->getUserId();

            $stmt->bindParam(':ip', $ip);
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_INT);
            $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error saving log: " . $e->getMessage());
        }
    }

    // Obtiene todos los registros de log detallados
    public function getAll(): array
    {
        $logs = [];

        try {
            $stmt = $this->pdo->prepare("SELECT id, ip, fecha, resultado, NOMBRE, APELLIDO, MAIL FROM vista_logs_detallada ORDER BY fecha DESC");
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $logs[] = $row;
            }
        } catch (PDOException $e) {
            error_log("Error al obtener logs: " . $e->getMessage());
        }

        return $logs;
    }
}
