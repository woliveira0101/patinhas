<?php

require_once 'Model.php';

class UserModel extends Model {
    protected $table = 'users';

    public function createUser($data) {
        $query = "INSERT INTO $this->table (address_id, user_name, email, phone_number, login, password, type, is_active, image, created_at, updated_at) 
                  VALUES (:address_id, :user_name, :email, :phone_number, :login, :password, :type, :is_active, :image, NOW(), NOW())";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'address_id' => $data['address_id'],
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'login' => $data['login'],
            'password' => $data['password'],
            'type' => $data['type'],
            'is_active' => $data['is_active'],
            'image' => $data['image']
        ]);
    }

    public function updateUser($data) {
        $query = "UPDATE $this->table 
                  SET address_id = :address_id, user_name = :user_name, email = :email, phone_number = :phone_number, 
                      login = :login, password = :password, type = :type, is_active = :is_active, image = :image, updated_at = NOW() 
                  WHERE user_id = :user_id";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'address_id' => $data['address_id'],
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'login' => $data['login'],
            'password' => $data['password'],
            'type' => $data['type'],
            'is_active' => $data['is_active'],
            'image' => $data['image'],
            'user_id' => $data['user_id']
        ]);
    }

    public function deleteUser($user_id) {
        $query = "DELETE FROM $this->table WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['user_id' => $user_id]);
    }

    public function getUserById($user_id) {
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
