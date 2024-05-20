<?php

namespace App\Controllers;

use App\Models\AddressModel;

class AddressController extends Controller {

    public function registration() {
        $this->view('address/registration');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                $this->setFlash('success', 'Endereço cadastrado com sucesso!');
                $this->redirect('/address/list');
            } else {
                $this->setFlash('error', 'Erro ao cadastrar endereço.');
                $this->redirect('/address/registration');
            }
        }
    }

    public function list() {
        if (!$this->isLoggedIn()) {
            $this->redirect('/user/login');
        }

        $addressModel = new AddressModel();
        $addresses = $addressModel->getByUserId($_SESSION['user_id']);
        $this->view('address/list', ['addresses' => $addresses]);
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $addressModel = new AddressModel();
            $address = $addressModel->getById($id, 'address_id');
            $this->view('address/edit', ['address' => $address]);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'zip_code' => $_POST['zip_code'],
                'street_name' => $_POST['street_name'],
                'address_number' => $_POST['address_number'],
                'address_complement' => $_POST['address_complement'],
                'neighboorhood' => $_POST['neighboorhood'],
                'city_name' => $_POST['city_name'],
                'state_name' => $_POST['state_name'],
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $addressModel = new AddressModel();
            if ($addressModel->update($id, $data, 'address_id')) {
                $this->setFlash('success', 'Endereço atualizado com sucesso!');
                $this->redirect('/address/list');
            } else {
                $this->setFlash('error', 'Erro ao atualizar endereço.');
                $this->redirect('/address/edit/' . $id);
            }
        }
    }

    public function delete($id) {
        $addressModel = new AddressModel();
        if ($addressModel->delete($id, 'address_id')) {
            $this->setFlash('success', 'Endereço excluído com sucesso!');
        } else {
            $this->setFlash('error', 'Erro ao excluir endereço.');
        }
        $this->redirect('/address/list');
    }
}
