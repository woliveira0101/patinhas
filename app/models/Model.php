<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Model {
    protected $conn;
    protected $table;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id, $idColumn = 'id') {
        $query = "SELECT * FROM " . $this->table . " WHERE $idColumn = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($query);

        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }

        return false;
    }

    public function update($id, $data, $idColumn = 'id') {
        $setClause = "";
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
        }
        $setClause = rtrim($setClause, ", ");

        $query = "UPDATE " . $this->table . " SET $setClause WHERE $idColumn = :id";

        $stmt = $this->conn->prepare($query);

        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function delete($id, $idColumn = 'id') {
        $query = "DELETE FROM " . $this->table . " WHERE $idColumn = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getLastInsertId() {
        return $this->conn->lastInsertId();
    }
}
