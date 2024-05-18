<?php

namespace App\Models;

use PDO;

class UserModel extends Model {
    protected $table = 'users'; // Corrigido para usar $table em vez de $tableName

    // Método para autenticar um usuário
    public function authenticate($login, $password) {
        $hashedPassword = hash('sha256', $password);
        $sql = "SELECT * FROM $this->table WHERE (email = :login OR login = :login) AND password = :password";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
