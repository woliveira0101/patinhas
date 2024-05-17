<?php

namespace App\Models;
//require __DIR__ . '/../../vendor/autoload.php';

class UserModel extends Model {
    protected $tableName;
    
    public function __construct() {
        parent::__construct();
        $this->tableName = 'users';
    }

    // Método para autenticar um usuário
    public function authenticate($login, $password) {
        $hashedPassword = hash('sha256', $password);
        $sql = "SELECT * FROM $this->tableName WHERE (email = :login OR login = :login) AND password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para obter um usuário pelo email
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM $this->tableName WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para obter um usuário pelo username
    public function getUserByUsername($username) {
        $sql = "SELECT * FROM $this->tableName WHERE login = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}
