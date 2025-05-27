<?php



class Log
{
    private string $ip;
    private int $resultType;
    private ?int $userId;

    public function __construct(string $ip, int $resultType, ?int $userId = null)
    {
        $this->ip = $ip;
        $this->resultType = $resultType;
        $this->userId = $userId;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getResultType(): int
    {
        return $this->resultType;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }
}
