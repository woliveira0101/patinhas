<?php

require_once 'Model.php';

class FormQuestionModel extends Model {
    protected $table = 'form_questions';

    public function create($data) {
        $query = "INSERT INTO $this->table (adoption_id, question_content, question_number, question_type, created_at, updated_at) 
                  VALUES (:adoption_id, :question_content, :question_number, :question_type, NOW(), NOW())";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'adoption_id' => $data['adoption_id'],
            'question_content' => $data['question_content'],
            'question_number' => $data['question_number'],
            'question_type' => $data['question_type']
        ]);
    }

    public function update($id, $data) {
        $query = "UPDATE $this->table 
                  SET adoption_id = :adoption_id, question_content = :question_content, 
                      question_number = :question_number, question_type = :question_type, 
                      updated_at = NOW() 
                  WHERE question_id = :question_id";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'adoption_id' => $data['adoption_id'],
            'question_content' => $data['question_content'],
            'question_number' => $data['question_number'],
            'question_type' => $data['question_type'],
            'question_id' => $id
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE question_id = :question_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['question_id' => $id]);
    }

}
