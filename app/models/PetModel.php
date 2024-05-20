<?php

namespace App\Models;

use PDO;

class PetModel extends Model {
    protected $table = 'pets';

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (pet_name, state, city, description, type, gender, breed, age, size, colour, personality, special_care, vaccinated, castrated, vermifuged, is_adopted, created_at, updated_at) 
        VALUES (:pet_name, :state, :city, :description, :type, :gender, :breed, :age, :size, :colour, :personality, :special_care, :vaccinated, :castrated, :vermifuged, :is_adopted, NOW(), NOW())";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':pet_name', $data['pet_name']);
        $stmt->bindParam(':state', $data['state']);
        $stmt->bindParam(':city', $data['city']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':gender', $data['gender']);
        $stmt->bindParam(':breed', $data['breed']);
        $stmt->bindParam(':age', $data['age']);
        $stmt->bindParam(':size', $data['size']);
        $stmt->bindParam(':colour', $data['colour']);
        $stmt->bindParam(':personality', $data['personality']);
        $stmt->bindParam(':special_care', $data['special_care']);
        $stmt->bindParam(':vaccinated', $data['vaccinated']);
        $stmt->bindParam(':castrated', $data['castrated']);
        $stmt->bindParam(':vermifuged', $data['vermifuged']);
        $stmt->bindParam(':is_adopted', $data['is_adopted']);

        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    // public function update($id, $data) {
    //     $query = "UPDATE $this->table 
    //               SET pet_name = :pet_name, state = :state, city = :city, description = :description, 
    //                   type = :type, gender = :gender, breed = :breed, age = :age, size = :size, 
    //                   colour = :colour, personality = :personality, special_care = :special_care, 
    //                   vaccinated = :vaccinated, castrated = :castrated, vermifuged = :vermifuged, 
    //                   is_adopted = :is_adopted, updated_at = NOW() 
    //               WHERE pet_id = :pet_id";

    //     $stmt = $this->conn->prepare($query);

    //     return $stmt->execute([
    //         'pet_name' => $data['pet_name'],
    //         'state' => $data['state'],
    //         'city' => $data['city'],
    //         'description' => $data['description'],
    //         'type' => $data['type'],
    //         'gender' => $data['gender'],
    //         'breed' => $data['breed'],
    //         'age' => $data['age'],
    //         'size' => $data['size'],
    //         'colour' => $data['colour'],
    //         'personality' => $data['personality'],
    //         'special_care' => $data['special_care'],
    //         'vaccinated' => $data['vaccinated'],
    //         'castrated' => $data['castrated'],
    //         'vermifuged' => $data['vermifuged'],
    //         'is_adopted' => $data['is_adopted'],
    //         'pet_id' => $id
    //     ]);
    // }

    // public function delete($id) {
    //     $query = "DELETE FROM $this->table WHERE pet_id = :pet_id";
    //     $stmt = $this->conn->prepare($query);
    //     return $stmt->execute(['pet_id' => $id]);
    // }

    // public function getById($id) {
    //     $query = "SELECT * FROM $this->table WHERE pet_id = :pet_id";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute(['pet_id' => $id]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    public function getAllPets() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

}
