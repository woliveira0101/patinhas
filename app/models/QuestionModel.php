<?php

namespace App\Models;

use PDO;

class QuestionModel extends Model {
    protected $table = 'questions';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (type_id, question_number, question_content, is_optional, is_active, created_at, updated_at) 
        VALUES (:type_id, :question_number, :question_content, :is_optional, :is_active, NOW(), NOW())";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':type_id', $data['type_id']);
        $stmt->bindParam(':question_number', $data['question_number']);
        $stmt->bindParam(':question_content', $data['question_content']);
        $stmt->bindParam(':is_optional', $data['is_optional']);
        $stmt->bindParam(':is_active', $data['is_active']);

        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function getAllActiveQuestions()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}