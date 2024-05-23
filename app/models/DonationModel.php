<?php

namespace App\Models;

use PDO;

class DonationModel extends Model {
    protected $table = 'donations';

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (user_id, pet_id, donation_date) VALUES (:user_id, :pet_id, :donation_date)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':pet_id', $data['pet_id']);
        $stmt->bindParam(':donation_date', $data['donation_date']);

        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    // public function getById($id) {
    //     $query = "SELECT * FROM $this->table WHERE donation_id = :donation_id";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':donation_id', $id);
    //     $stmt->execute();
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    public function getByUserId($userId)
    {
        $query = "SELECT d.*, p.pet_name, p.type, p.breed, a.status 
                  FROM " . $this->table . " d
                  JOIN pets p ON d.pet_id = p.pet_id
                  LEFT JOIN adoptions a ON a.pet_id = p.pet_id
                  WHERE d.user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLatestDonations() {
        $query = "
            SELECT donations.*, users.name as user_name, pets.pet_name 
            FROM donations
            JOIN users ON donations.user_id = users.user_id
            JOIN pets ON donations.pet_id = pets.pet_id
            ORDER BY donations.donation_date DESC
            LIMIT 5
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // public function update($id, $data) {
    //     $setClause = "";
    //     foreach ($data as $key => $value) {
    //         $setClause .= "$key = :$key, ";
    //     }
    //     $setClause = rtrim($setClause, ", ");

    //     $query = "UPDATE $this->table SET $setClause WHERE donation_id = :donation_id";
    //     $stmt = $this->conn->prepare($query);

    //     foreach ($data as $key => &$value) {
    //         $stmt->bindParam(":$key", $value);
    //     }
    //     $stmt->bindParam(":donation_id", $id);

    //     return $stmt->execute();
    // }

    // public function delete($id) {
    //     $query = "DELETE FROM $this->table WHERE donation_id = :donation_id";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':donation_id', $id);
    //     return $stmt->execute();
    // }
}
