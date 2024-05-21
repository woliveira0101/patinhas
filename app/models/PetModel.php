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

    public function getFilteredPets($filters = []) {
        $query = "SELECT * FROM " . $this->table;
        $conditions = [];
        $params = [];
    
        if (!empty($filters['type'])) {
            $typePlaceholders = implode(', ', array_fill(0, count($filters['type']), '?'));
            $conditions[] = "type IN ($typePlaceholders)";
            $params = array_merge($params, $filters['type']);
        }
        if (!empty($filters['gender'])) {
            $genderPlaceholders = implode(', ', array_fill(0, count($filters['gender']), '?'));
            $conditions[] = "gender IN ($genderPlaceholders)";
            $params = array_merge($params, $filters['gender']);
        }
        if (!empty($filters['age'])) {
            $agePlaceholders = implode(', ', array_fill(0, count($filters['age']), '?'));
            $conditions[] = "age <= ?";
            $params[] = max($filters['age']);
        }
        if (!empty($filters['size'])) {
            $sizePlaceholders = implode(', ', array_fill(0, count($filters['size']), '?'));
            $conditions[] = "size IN ($sizePlaceholders)";
            $params = array_merge($params, $filters['size']);
        }
    
        if ($conditions) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        $pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($pets as &$pet) {
            $queryImages = "SELECT image FROM pet_images WHERE pet_id = :pet_id";
            $stmtImages = $this->conn->prepare($queryImages);
            $stmtImages->bindParam(':pet_id', $pet['pet_id']);
            $stmtImages->execute();
            $pet['images'] = $stmtImages->fetchAll(PDO::FETCH_ASSOC);
        }
    
        return $pets;
    }
        
     

    public function getAllPets() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

}
