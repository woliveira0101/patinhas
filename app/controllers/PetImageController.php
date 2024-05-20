<?php

namespace App\Controllers;

use App\Models\PetImageModel;

class PetImageController extends Controller {
    public function delete($id) {
        $petImageModel = new PetImageModel();
        $image = $petImageModel->getById($id, 'image_id');

        if ($image) {
            $imagePath = __DIR__ . '/../../public/assets/img/pets/' . $image['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            if ($petImageModel->delete($id, 'image_id')) {
                http_response_code(200);
                echo json_encode(['status' => 'success']);
                exit();
            }
        }

        http_response_code(400);
        echo json_encode(['status' => 'error']);
    }
}
