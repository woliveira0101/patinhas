<?php

namespace App\Models;

use PDO;

class AdoptionModel extends Model {
    protected $table = 'adoptions';

    public function create($data) {
        $query = "INSERT INTO $this->table (user_id, pet_id, adoption_date, status) 
                  VALUES (:user_id, :pet_id, NOW(), :status)";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'user_id' => $data['user_id'],
            'pet_id' => $data['pet_id'],
            'status' => $data['status']
        ]);
    }

    // public function update($id, $data) {
    //     $query = "UPDATE $this->table 
    //               SET user_id = :user_id, pet_id = :pet_id, adoption_date = NOW(), status = :status
    //               WHERE adoption_id = :adoption_id";

    //     $stmt = $this->db->prepare($query);

    //     return $stmt->execute([
    //         'user_id' => $data['user_id'],
    //         'pet_id' => $data['pet_id'],
    //         'status' => $data['status'],
    //         'adoption_id' => $id
    //     ]);
    // }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE adoption_id = :adoption_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['adoption_id' => $id]);
    }

    // public function getById($id) {
    //     $query = "SELECT * FROM $this->table WHERE adoption_id = :adoption_id";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute(['adoption_id' => $id]);
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
