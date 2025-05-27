<?php
require_once BASE_PATH . '/config/Database.php';
require_once BASE_PATH . '/app/model/User.php';

class UserRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    // Obtiene un usuario por correo electrónico y opcionalmente por teléfono
    public function getUser(string $mail, ?string $phone = null): ?User
    {
        $userObject = null;

        try {
            $query = "SELECT ID_USUARIO, NOMBRE, APELLIDO, MAIL, CLAVE, TIPO_USUARIO, TELEFONO, direccion, intentos_fallidos, bloqueo_hasta 
                      FROM vista_usuarios WHERE MAIL = :mail";
            if ($phone) {
                $query .= " AND TELEFONO = :phone";
            }

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            if ($phone) {
                $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            }

            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $userObject = new User(
                    $user['ID_USUARIO'],
                    $user['NOMBRE'],
                    $user['APELLIDO'],
                    $user['MAIL'],
                    $user['CLAVE'],
                    $user['TIPO_USUARIO'],
                    $user['TELEFONO'],
                    $user['direccion'],
                    $user['intentos_fallidos'],
                    $user['bloqueo_hasta']
                );
            }
        } catch (PDOException $e) {
            error_log("Error en getUser: " . $e->getMessage());
        }

        return $userObject;
    }

    // Obtiene todos los usuarios no administradores
    public function getAllNonAdminUsers(): array
    {
        $usuarios = [];

        try {

            $stmt = $this->pdo->prepare("SELECT ID_USUARIO, NOMBRE, APELLIDO, MAIL, TELEFONO, estado FROM vista_admin WHERE ID_TIPOUSUARIO != 2");
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $usuarios[] = $row;
            }
        } catch (PDOException $e) {
            error_log("Error al obtener usuarios no administradores: " . $e->getMessage());
        }

        return $usuarios;
    }

    // Incrementa los intentos fallidos
    public function increaseFailedAttempt(string $mail): void
    {
        try {

            $query = "UPDATE usuarios SET intentos_fallidos = intentos_fallidos + 1 WHERE MAIL = :mail";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al incrementar intentos fallidos: " . $e->getMessage());
        }
    }

    // Obtiene los intentos fallidos de un usuario
    public function getFailedAttempts(string $mail): int
    {
        $attemps = 0;

        try {

            $query = "SELECT intentos_fallidos FROM usuarios WHERE MAIL = :mail";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $attemps = (int)$result['intentos_fallidos'];
            }
        } catch (PDOException $e) {
            error_log("Error al obtener intentos fallidos: " . $e->getMessage());
        }

        return $attemps;
    }

    // Bloquea un usuario por 10 minutos
    public function blockUser(string $mail): void
    {
        try {

            $block = date('Y-m-d H:i:s', strtotime('+10 minutes'));

            $query = "UPDATE usuarios SET bloqueo_hasta = :bloqueo, estado = 'Bloqueado' WHERE MAIL = :mail";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':bloqueo', $block, PDO::PARAM_STR);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al bloquear usuario: " . $e->getMessage());
        }
    }

    // Resetea los intentos fallidos y desbloquea al usuario
    public function resetFailedAttempts(string $mail): void
    {
        try {

            $query = "UPDATE usuarios SET intentos_fallidos = 0, bloqueo_hasta = NULL, estado = 'Activado' WHERE MAIL = :mail";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en resetFailedAttempts: " . $e->getMessage());
        }
    }

    // Actualiza la contraseña de un usuario
    public function updatePassword(int $userId, string $newPassword): bool
    {
        $success = false;

        try {

            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            $query = "UPDATE usuarios SET clave = :newPassword WHERE ID_USUARIO = :userId";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':newPassword', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

            $success = $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar la contraseña: " . $e->getMessage());
        }

        return $success;
    }

    // Registra un nuevo usuario
    public function registerUser(string $name, string $surname, string $phone, string $address, string $mail, string $clave): bool
    {
        $success = false;

        try {

            $stmt = $this->pdo->prepare("INSERT INTO usuarios (NOMBRE, APELLIDO, TELEFONO, DIRECCION, MAIL, CLAVE, ID_TIPOUSUARIO)
                                   VALUES (:nombre, :apellido, :phone, :direccion, :mail, :clave, 1)");
            $stmt->bindParam(':nombre', $name);
            $stmt->bindParam(':apellido', $surname);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':direccion', $address);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':clave', $clave);
            $success = $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en registerUser: " . $e->getMessage());
        }

        return $success;
    }

    // Actualiza los datos de un usuario
    public function updateUser(int $id, string $mail, string $address, string $phone): bool
    {
        $success = false;
        try {
            $stmt = $this->pdo->prepare("UPDATE usuarios SET MAIL = :mail,DIRECCION = :direccion, TELEFONO = :telefono WHERE ID_USUARIO = :id");
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':direccion', $address);
            $stmt->bindParam(':telefono', $phone);
            $stmt->bindParam(':id', $id);
            $success = $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en actualizarDatos: " . $e->getMessage());
        }
        return $success;
    }

    // Elimina un usuario por ID
    public function deleteById(int $id): bool
    {
        $success = false;
        try {

            $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE ID_USUARIO = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $success = $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en eliminarPorId: " . $e->getMessage());
        }
        return $success;
    }

    // Actualiza el estado de un usuario
    public function updateUserState(int $id, string $estado): bool
    {
        $success = false;
        try {

            $stmt = $this->pdo->prepare("UPDATE usuarios SET estado = :estado WHERE ID_USUARIO = :id");
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $success =  $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar estado del usuario: " . $e->getMessage());
        }
        return $success;
    }

    // Obtiene el estado de un usuario por ID
    public function getState(int $id): ?string
    {
        $estado = null;

        try {
            $stmt = $this->pdo->prepare("SELECT estado FROM usuarios WHERE ID_USUARIO = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $estado = $row['estado'];
            }
        } catch (PDOException $e) {
            error_log("Error al obtener estado del usuario: " . $e->getMessage());
        }

        return $estado;
    }
}
