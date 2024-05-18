<?php

namespace App\Models;

use PDO;

class DonationModel extends Model {
    protected $table = 'donations';

    public function create($data) {
        $query = "INSERT INTO $this->table (user_id, pet_id, donation_date) 
                  VALUES (:user_id, :pet_id, NOW())";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'user_id' => $data['user_id'],
            'pet_id' => $data['pet_id']
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE donation_id = :donation_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['donation_id' => $id]);
    }

    // public function getById($id) {
    //     $query = "SELECT * FROM $this->table WHERE donation_id = :donation_id";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute(['donation_id' => $id]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }
    
    public function getByUserId($userId) {
        $sql = "SELECT * FROM $this->table WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
