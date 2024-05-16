<?php

require_once 'Model.php';

class PetImageModel extends Model {
    protected $table = 'pet_images';

    public function create($data) {
        $query = "INSERT INTO $this->table (pet_id, image, created_at) 
                  VALUES (:pet_id, :image, NOW())";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'pet_id' => $data['pet_id'],
            'image' => $data['image']
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE image_id = :image_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['image_id' => $id]);
    }

    public function getByPetId($pet_id) {
        $query = "SELECT * FROM $this->table WHERE pet_id = :pet_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['pet_id' => $pet_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
