<?php

namespace App\Controllers;

use App\Models\AddressModel;

class AddressController extends Controller {

    public function registration() {
        $this->view('address/registration');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Verifique se o usuário está logado
            if (!isset($_SESSION['user_id'])) {
                $this->redirect('/user/login');
                return;
            }

            $data = [
                'user_id' => $_SESSION['user_id'],
                'zip_code' => $_POST['zip_code'],
                'street_name' => $_POST['street_name'],
                'address_number' => $_POST['address_number'],
                'address_complement' => $_POST['address_complement'],
                'neighboorhood' => $_POST['neighboorhood'],
                'city_name' => $_POST['city_name'],
                'state_name' => $_POST['state_name'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $addressModel = new AddressModel();
            if ($addressModel->create($data)) {
                $this->setFlash('success', 'Endereço registrado com sucesso!');
                $this->redirect('/user/profile');
            } else {
                $this->setFlash('error', 'Erro ao registrar o endereço.');
                $this->redirect('/address/registration');
            }
        } else {
            $this->view('address/registration');
        }
    }
}
