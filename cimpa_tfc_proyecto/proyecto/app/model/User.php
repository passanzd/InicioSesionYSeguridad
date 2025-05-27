<?php

class User
{
    private int $id;
    private string $name;
    private string $lastName;
    private string $mail;
    private string $password;
    private string $user_type;
    private string $phone;
    private string $address;
    private int $attemps = 0;
    private ?string $block = null;



    public function __construct(int $id, string $name, string $lastName, string $mail, string $password, string $user_type, string $phone, string $address, int $attemps = 0, ?string $block = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->mail = $mail;
        $this->password = $password;
        $this->user_type = $user_type;
        $this->phone = $phone;
        $this->address = $address;
        $this->attemps = $attemps;
        $this->block = $block;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getMail(): string
    {
        return $this->mail;
    }
    public function getUserType(): string
    {
        return $this->user_type;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getAttemps(): int
    {
        return $this->attemps;
    }
    public function getBlock(): ?string
    {
        return $this->block;
    }

    public function setAttemps(int $attemps)
    {
        $this->attemps = $attemps;
    }
    public function setBlocks(?string $block)
    {
        $this->block = $block;
    }
}
