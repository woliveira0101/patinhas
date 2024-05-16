<?php

require_once 'Model.php';

class AddressModel extends Model {
    protected $table = 'address';

    public function createAddress($data) {
        $query = "INSERT INTO $this->table (zip_code, street_name, neighboorhood, city_name, state_name, address_complement) 
                  VALUES (:zip_code, :street_name, :neighboorhood, :city_name, :state_name, :address_complement)";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'zip_code' => $data['zip_code'],
            'street_name' => $data['street_name'],
            'neighboorhood' => $data['neighboorhood'],
            'city_name' => $data['city_name'],
            'state_name' => $data['state_name'],
            'address_complement' => $data['address_complement']
        ]);
    }

    public function updateAddress($data) {
        $query = "UPDATE $this->table 
                  SET zip_code = :zip_code, street_name = :street_name, neighboorhood = :neighboorhood, city_name = :city_name, 
                      state_name = :state_name, address_complement = :address_complement 
                  WHERE address_id = :address_id";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'zip_code' => $data['zip_code'],
            'street_name' => $data['street_name'],
            'neighboorhood' => $data['neighboorhood'],
            'city_name' => $data['city_name'],
            'state_name' => $data['state_name'],
            'address_complement' => $data['address_complement'],
            'address_id' => $data['address_id']
        ]);
    }

    public function deleteAddress($address_id) {
        $query = "DELETE FROM $this->table WHERE address_id = :address_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['address_id' => $address_id]);
    }

    public function getAddressById($address_id) {
        $query = "SELECT * FROM $this->table WHERE address_id = :address_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['address_id' => $address_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
