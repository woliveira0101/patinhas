<?php

namespace App\Models;

use PDO;

class UserModel extends Model {
    protected $table = 'users'; 

    // Método para autenticar um usuário
    public function authenticate($login, $password) {
        $sql = "SELECT * FROM {$this->table} WHERE email = :login OR login = :login";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar se o usuário existe e se a senha é correta
        if ($user && password_verify($password, $user['password'])) {
            //var_dump($user);
            unset($user['password']);
            return $user;
        }

        return false;
    }

    // Método para obter um usuário pelo email
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM $this->table WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para obter um usuário pelo username
    public function getUserByUsername($username) {
        $sql = "SELECT * FROM $this->table WHERE login = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
