<?php

require_once 'Model.php';

class QuestionAnswerModel extends Model {
    protected $table = 'question_answers';

    public function create($data) {
        $query = "INSERT INTO $this->table (question_id, answer_content, created_at) 
                  VALUES (:question_id, :answer_content, NOW())";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'question_id' => $data['question_id'],
            'answer_content' => $data['answer_content']
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE answer_id = :answer_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['answer_id' => $id]);
    }

}
