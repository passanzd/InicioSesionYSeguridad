<?php
require_once BASE_PATH . '/app/repository/UserRepository.php';

class UserService
{
    private UserRepository $userRepo;
    private ?string $error = null;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    // Valida los datos de registro de un nuevo usuario
    public function validateRegistration(string $mail, string $password, string $confirmPassword): bool
    {
        $this->error = null;

        if (empty($mail) || empty($password) || empty($confirmPassword)) {
            $this->error = "Todos los campos son obligatorios.";
        }

        if (!$this->error && !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $this->error = "Correo electrónico inválido.";
        }

        if (!$this->error && $password !== $confirmPassword) {
            $this->error = "Las contraseñas no coinciden.";
        }

        if (!$this->error && $this->userRepo->getUser($mail)) {
            $this->error = "El correo ya está registrado.";
        }

        return $this->error === null;
    }


    public function getError(): ?string
    {
        return $this->error;
    }

    // Registrar un nuevo usuario
    public function registerUser(string $name, string $surname, string $phone, string $address, string $mail, string $password): bool
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        return $this->userRepo->registerUser($name, $surname, $phone, $address, $mail, $passwordHash);
    }

    // Obtiene el usuario por correo electrónico y teléfono
    public function getUserByMailAndPhone(string $mail, string $phone): ?User
    {
        return $this->userRepo->getUser($mail, $phone);
    }

    // Obtiene el usuario por correo electrónico
    public function getUserByMail(string $mail): ?User
    {
        return $this->userRepo->getUser($mail);
    }

    // Actualizar contraseña
    public function resetPassword(int $userId, string $newPassword): bool
    {

        return $this->userRepo->updatePassword($userId, $newPassword);
    }

    // Obtiene los usuarios no administradores
    public function getNonAdminUsers(): array
    {
        return $this->userRepo->getAllNonAdminUsers();
    }

    // Actualizar datos del usuario
    public function updateUserData(int $id, string $mail, string $address, string $phone): bool
    {
        return $this->userRepo->updateUser($id, $mail, $address, $phone);
    }

    // Elimina usuario por ID
    public function deleteUserData(int $id): bool
    {
        return $this->userRepo->deleteById($id);
    }
    // Actualiza el estado del usuario
    public function editUserState(int $id, string $estado): bool
    {
        return $this->userRepo->updateUserState($id, $estado);
    }

    // Obtiene el estado del usuario por ID
    public function getStateUser(int $id): ?string
    {
        return $this->userRepo->getState($id);
    }
}
