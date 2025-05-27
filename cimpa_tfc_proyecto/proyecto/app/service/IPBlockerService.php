<?php
require_once BASE_PATH . '/app/repository/IPBlockerRepository.php';

class IPBlockerService
{
    private IPBlockerRepository $ipRepo;

    public function __construct(IPBlockerRepository $ipRepo)
    {
        $this->ipRepo = $ipRepo;
    }
    // Obtiene la IP del cliente
    public function getClientIP(): string
    {
        return $this->ipRepo->getClientIP();
    }

    // Valida el acceso basado en la IP y el usuario
    public function validateAccess(string $ip, ?int $userId = null): ?string
    {
        $errorMessage = null;

        if (!$this->ipRepo->isIPAuthorized($ip, $userId)) {
            $errorMessage = "Tu IP no está autorizada para acceder.";
        } elseif (!$this->ipRepo->isLocationAllowed($ip, $userId)) {
            $errorMessage = "El acceso desde tu país no está permitido.";
        }

        return $errorMessage;
    }
}
