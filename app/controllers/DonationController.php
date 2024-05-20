<?php

namespace App\Controllers;

use App\Models\DonationModel;
use App\Models\PetModel;
use App\Models\PetImageModel;

class DonationController extends Controller {

    // Método para exibir o formulário de doação
    public function create() {
        if (!$this->isLoggedIn()) {
            $this->setFlash('redirect_after_login', '/donations/create');
            $this->redirect('/user/register');
        }
        $this->view('donations/form_doacao');
    }

    public function myDonations() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/user/login');
        }

        $userId = $_SESSION['user_id'];
        $donationModel = new DonationModel();
        $donations = $donationModel->getByUserId($userId);

        $this->view('admin/mydonations', ['donations' => $donations]);
    }

    // Método para processar a submissão do formulário de doação
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $petData = [
                'pet_name' => $_POST['nomePet'],
                'description' => $_POST['descricaoPet'],
                'type' => $_POST['form_especie'],
                'gender' => $_POST['form_sexo'],
                'breed' => $_POST['racaPet'],
                'age' => $_POST['idadePet'],
                'size' => $_POST['sizePet'],
                'state' => $_POST['form_estado'],
                'city' => $_POST['form_cidade'],
                'colour' => $_POST['colourPet'],
                'personality' => $_POST['personalidadePet'],
                'special_care' => $_POST['necessidadesEspeciaisPet'],
                'vaccinated' => isset($_POST['vaccinated']) ? 1 : 0,
                'castrated' => isset($_POST['castrated']) ? 1 : 0,
                'vermifuged' => isset($_POST['vermifuged']) ? 1 : 0,
                'is_adopted' => 0, // Valor padrão
            ];

            $petModel = new PetModel();
            $petId = $petModel->create($petData);
            if ($petId) {
                $userId = $_SESSION['user_id'];
                $donationData = [
                    'user_id' => $userId,
                    'pet_id' => $petId,
                    'donation_date' => date('Y-m-d H:i:s')
                ];

                $donationModel = new DonationModel();
                $donationModel->create($donationData);

                // Handle image uploads
                if (!empty($_FILES['fotosPet']['name'][0])) {
                    $petImageModel = new PetImageModel();
                    foreach ($_FILES['fotosPet']['name'] as $key => $image) {
                        $imageTmpName = $_FILES['fotosPet']['tmp_name'][$key];
                        $imageExtension = pathinfo($image, PATHINFO_EXTENSION);

                        // Save the image to the database to get the image ID
                        $petImageData = [
                            'pet_id' => $petId,
                            'image' => ''
                        ];
                        $imageId = $petImageModel->create($petImageData);
                        if ($imageId) {
                            // Rename the image
                            $imageName = $petId . '_' . $imageId . '_' . date('YmdHis') . '.' . $imageExtension;
                            $imagePath = __DIR__ . '/../../public/assets/img/pets/' . $imageName;
                            move_uploaded_file($imageTmpName, $imagePath);

                            // Update the image record with the correct name
                            $petImageModel->update($imageId, ['image' => $imageName], 'image_id');
                        }
                    }
                }

                $this->setFlash('success', 'Doação cadastrada com sucesso!');
                $this->redirect('/admin/mydonations');
            } else {
                $this->setFlash('error', 'Erro ao cadastrar a doação.');
                $this->redirect('/donations/create');
            }
        } else {
            $this->view('donations/form_doacao');
        }
    }

    public function edit($id) {
        if (!$this->isLoggedIn()) {
            $this->redirect('/user/login');
        }

        $donationModel = new DonationModel();
        $donation = $donationModel->getById($id, 'donation_id');

        if ($donation) {
            $petModel = new PetModel();
            $pet = $petModel->getById($donation['pet_id'], 'pet_id');

            if ($pet) {
                $petImageModel = new PetImageModel();
                $images = $petImageModel->getByPetId($donation['pet_id']);

                $donation = array_merge($donation, $pet);
                $donation['images'] = $images;
                $this->view('donations/edit', ['donation' => $donation]);
            } else {
                $this->setFlash('error', 'Pet não encontrado.');
                $this->redirect('/admin/mydonations');
            }
        } else {
            $this->setFlash('error', 'Doação não encontrada.');
            $this->redirect('/admin/mydonations');
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $petData = [
                'pet_name' => $_POST['nomePet'],
                'description' => $_POST['descricaoPet'],
                'type' => $_POST['form_especie'],
                'gender' => $_POST['form_sexo'],
                'breed' => $_POST['racaPet'],
                'age' => $_POST['idadePet'],
                'size' => $_POST['sizePet'],
                'state' => $_POST['form_estado'],
                'city' => $_POST['form_cidade'],
                'colour' => $_POST['colourPet'],
                'personality' => $_POST['personalidadePet'],
                'special_care' => $_POST['necessidadesEspeciaisPet'],
                'vaccinated' => isset($_POST['vaccinated']) ? 1 : 0,
                'castrated' => isset($_POST['castrated']) ? 1 : 0,
                'vermifuged' => isset($_POST['vermifuged']) ? 1 : 0,
            ];

            $petModel = new PetModel();
            $petModel->update($id, $petData, 'pet_id');

            if (!empty($_FILES['fotosPet']['name'][0])) {
                $petImageModel = new PetImageModel();
                foreach ($_FILES['fotosPet']['name'] as $key => $image) {
                    $imageTmpName = $_FILES['fotosPet']['tmp_name'][$key];
                    $imageExtension = pathinfo($image, PATHINFO_EXTENSION);

                    $petImageData = [
                        'pet_id' => $id,
                        'image' => ''
                    ];
                    $imageId = $petImageModel->create($petImageData);
                    if ($imageId) {
                        $imageName = $id . '_' . $imageId . '_' . date('YmdHis') . '.' . $imageExtension;
                        $imagePath = __DIR__ . '/../../public/assets/img/pets/' . $imageName;
                        move_uploaded_file($imageTmpName, $imagePath);

                        $petImageModel->update($imageId, ['image' => $imageName], 'image_id');
                    }
                }
            }

            $this->setFlash('success', 'Doação atualizada com sucesso!');
            $this->redirect('/admin/mydonations');
        } else {
            $this->redirect('/admin/mydonations');
        }
    }

    public function getById($id, $idColumn = 'donation_id') {
        $query = "SELECT d.*, p.pet_name, p.description, p.type, p.gender, p.breed, p.age, p.size, p.state, p.city, p.colour, p.personality, p.special_care, p.vaccinated, p.castrated, p.vermifuged 
                  FROM " . $this->table . " d
                  JOIN pets p ON d.pet_id = p.pet_id
                  WHERE d.$idColumn = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $donation = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($donation) {
            $queryImages = "SELECT * FROM pet_images WHERE pet_id = :pet_id";
            $stmtImages = $this->conn->prepare($queryImages);
            $stmtImages->bindParam(':pet_id', $donation['pet_id']);
            $stmtImages->execute();
            $donation['images'] = $stmtImages->fetchAll(PDO::FETCH_ASSOC);
        }

        return $donation;
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $donationModel = new DonationModel();
            $donation = $donationModel->getById($id, 'donation_id');

            if ($donation) {
                $petModel = new PetModel();
                $petImageModel = new PetImageModel();

                // Delete pet images
                $images = $petImageModel->getByPetId($donation['pet_id']);
                foreach ($images as $image) {
                    $imagePath = __DIR__ . '/../../public/assets/img/pets/' . $image['image'];
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                    $petImageModel->delete($image['image_id'], 'image_id');
                }

                // Delete pet
                $petModel->delete($donation['pet_id'], 'pet_id');

                // Delete donation
                $donationModel->delete($id, 'donation_id');

                $this->setFlash('success', 'Doação excluída com sucesso.');
                http_response_code(200);
                echo json_encode(['status' => 'success']);
            } else {
                $this->setFlash('error', 'Doação não encontrada.');
                http_response_code(404);
                echo json_encode(['status' => 'error']);
            }
        }
    }
}
