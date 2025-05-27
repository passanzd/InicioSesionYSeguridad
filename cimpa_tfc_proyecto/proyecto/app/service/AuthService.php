<?php
require_once BASE_PATH . '/app/repository/UserRepository.php';

class AuthService
{
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    // Verifica las credenciales del usuario
    public function verifyUser(string $mail, string $password): ?User
    {
        $usuario = $this->userRepo->getUser($mail);
        $esValido = true;

        if (!$usuario) {

            $esValido = false;
        } else {

            $bloqueo = $usuario->getBlock();
            if ($bloqueo !== null && strtotime($bloqueo) < time()) {
                // Si el bloqueo ha expirado, lo reseteamos
                $this->userRepo->resetFailedAttempts($mail);
            }


            if ($this->isBlocked($usuario)) {

                $esValido = false;
            } elseif (!$this->verifyPassword($password, $usuario->getPassword())) {

                $this->handleFailedLogin($mail);
                $esValido = false;
            } elseif (trim(strtolower($this->userRepo->getState($usuario->getId()))) !== 'activado') {

                $esValido = false;
            } else {

                $this->userRepo->resetFailedAttempts($mail); // Seguridad adicional
            }
        }

        return $esValido ? $usuario : null;
    }



    // Verifica si la contraseña ingresada coincide con la almacenada
    private function verifyPassword(string $inputPassword, string $hashedPassword): bool
    {
        return password_verify($inputPassword, $hashedPassword);
    }

    // Verifica si el usuario está bloqueado
    private function isBlocked(User $usuario): bool
    {
        $bloqueo = $usuario->getBlock();
        return $bloqueo !== null && strtotime($bloqueo) > time();
    }

    // Maneja el inicio de sesión fallido, incrementando los intentos y bloqueando al usuario si es necesario
    private function handleFailedLogin(string $mail): void
    {
        $this->userRepo->increaseFailedAttempt($mail);
        $attemps = $this->userRepo->getFailedAttempts($mail);

        if ($attemps >= 3) {
            $this->userRepo->blockUser($mail);
        }
    }
    // Verifica si un usuario está bloqueado por su correo electrónico  
    public function isUserBlocked(string $mail): bool
    {
        $usuario = $this->userRepo->getUser($mail);
        return $usuario && $this->isBlocked($usuario);
    }
}
