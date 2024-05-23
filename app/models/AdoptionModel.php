<?php

namespace App\Models;

use PDO;

class AdoptionModel extends Model {
    protected $table = 'adoptions';

    public function request($data)
    {
        $query = "INSERT INTO adoptions (user_id, pet_id, request_date, status) VALUES (:user_id, :pet_id, NOW(), :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':pet_id', $data['pet_id']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->execute();
    
        $adoptionId = $this->conn->lastInsertId();
    
        foreach ($data['answers'] as $questionId => $answerContent) {
            // Primeiro, insere na tabela adoptions_questions
            $queryAdoptionsQuestions = "INSERT INTO adoptions_questions (adoption_id, question_id, created_at) VALUES (:adoption_id, :question_id, NOW())";
            $stmtAdoptionsQuestions = $this->conn->prepare($queryAdoptionsQuestions);
            $stmtAdoptionsQuestions->bindParam(':adoption_id', $adoptionId);
            $stmtAdoptionsQuestions->bindParam(':question_id', $questionId);
            $stmtAdoptionsQuestions->execute();
    
            // Depois, insere na tabela answers
            $queryAnswers = "INSERT INTO answers (adoption_id, question_id, answer_content) VALUES (:adoption_id, :question_id, :answer_content)";
            $stmtAnswers = $this->conn->prepare($queryAnswers);
            $stmtAnswers->bindParam(':adoption_id', $adoptionId);
            $stmtAnswers->bindParam(':question_id', $questionId);
            $stmtAnswers->bindParam(':answer_content', $answerContent);
            $stmtAnswers->execute();
        }
    
        return $adoptionId;
    }

    public function getByUserId($userId) {
        $query = "SELECT d.*, p.pet_name, p.type, p.breed, a.status 
                  FROM " . $this->table . " d
                  JOIN pets p ON d.pet_id = p.pet_id
                  LEFT JOIN adoptions a ON a.pet_id = p.pet_id
                  WHERE d.user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }

    public function updateStatus($adoptionId, $status)
{
    $query = "UPDATE adoptions SET status = :status WHERE adoption_id = :adoption_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':adoption_id', $adoptionId);
    $stmt->execute();
}

}
