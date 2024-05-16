<?php

require_once 'Model.php';

class DonationModel extends Model {
    protected $table = 'donations';

    public function create($data) {
        $query = "INSERT INTO $this->table (user_id, pet_id, donation_date) 
                  VALUES (:user_id, :pet_id, NOW())";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'user_id' => $data['user_id'],
            'pet_id' => $data['pet_id']
        ]);
    }

    public function update($id, $data) {
        // In this case, there might not be an update operation for donations
        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE donation_id = :donation_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['donation_id' => $id]);
    }

    public function getById($id) {
        $query = "SELECT * FROM $this->table WHERE donation_id = :donation_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['donation_id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
