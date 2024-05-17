<?php

require_once 'Model.php';

class UserModel extends Model {
    protected $table = 'users';
    private $user_id;
    private $user_name;
    private $login;
    private $password;
    private $email;
    private $phone_number;
    private $type;
    private $is_active;
    private $image;
    private $created_at;
    private $updated_at;

    public function __construct($user_id = null, $user_name = null, $login = null, $password = null, $email = null, $phone_number = null, $type = null, $is_active = null, $image = null, $created_at = null, $updated_at = null) {
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->type = $type;
        $this->is_active = $is_active;
        $this->image = $image;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
    

    public function createUser($data) {
        $query = "INSERT INTO $this->table (user_name, email, phone_number, login, password, type, is_active, image, created_at, updated_at) 
                  VALUES (:user_name, :email, :phone_number, :login, :password, :type, :is_active, :image, NOW(), NOW())";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
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
                  SET user_name = :user_name, email = :email, phone_number = :phone_number, 
                      login = :login, password = :password, type = :type, is_active = :is_active, image = :image, updated_at = NOW() 
                  WHERE user_id = :user_id";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
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

    public static function authenticate($username, $password)
    {
        $db = Database::getInstance();

        $stmt = $db->prepare('SELECT * FROM users WHERE login = :username');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            $authenticatedUser = new UserModel(
                $user['user_id'],
                $user['user_name'],
                $user['login'],
                $user['password'],
                $user['email'],
                $user['phone_number'],
                $user['type'],
                $user['is_active'],
                $user['image'],
                $user['created_at'],
                $user['updated_at']
            );
            //var_dump($authenticatedUser);
            return $authenticatedUser;
        } else {
            return false;
        }
    }

    public function getUserById($user_id) {
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getUserId() {
        return $this->user_id;
    }

    public function getUserName() {
        return $this->user_name;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhoneNumber() {
        return $this->phone_number;
    }

    public function getType() {
        return $this->type;
    }

    public function getIsActive() {
        return $this->is_active;
    }

    public function getImage() {
        return $this->image;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }
}
