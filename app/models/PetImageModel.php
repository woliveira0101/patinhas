<?php

namespace App\Models;

use PDO;

class PetImageModel extends Model {
    protected $table = 'pet_images';

    // public function create($data)
    // {
    //     $query = "INSERT INTO " . $this->table . " (pet_id, image, created_at) VALUES (:pet_id, :image, NOW())";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute([
    //         'pet_id' => $data['pet_id'],
    //         'image' => $data['image']
    //     ]);

    //     return $this->conn->lastInsertId();
    // }

    // public function update($id, $data)
    // {
    //     $query = "UPDATE " . $this->table . " SET image = :image WHERE image_id = :image_id";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute([
    //         'image' => $data['image'],
    //         'image_id' => $id
    //     ]);

    //     return $stmt->rowCount();
    // }
    // public function create($data) {
    //     $query = "INSERT INTO $this->table (pet_id, image) VALUES (:pet_id, :image)";
    //     $stmt = $this->conn->prepare($query);
    //     return $stmt->execute($data);
    // }

    // public function delete($id) {
    //     $query = "DELETE FROM $this->table WHERE image_id = :image_id";
    //     $stmt = $this->conn->prepare($query);
    //     return $stmt->execute(['image_id' => $id]);
    // }

    public function getByPetId($pet_id) {
        $query = "SELECT * FROM $this->table WHERE pet_id = :pet_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['pet_id' => $pet_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
