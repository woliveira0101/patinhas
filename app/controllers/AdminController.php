<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DonationModel;
use App\Models\AdoptionModel;

class AdminController extends Controller {
    public function dashboard() {
        // Renderizar a view do dashboard
        $this->view('admin/dashboard');
    }

    public function myDonations() {
        $donationModel = new DonationModel();
        $donations = $donationModel->getByUserId($_SESSION['user_id']);

        // Passar os dados das doações para a view
        $this->view('admin/mydonations', ['donations' => $donations]);
    }

    public function myAdoptions() {
        $adoptionModel = new AdoptionModel();
        $adoptions = $adoptionModel->getByUserId($_SESSION['user_id']);

        // Passar os dados das adoções para a view
        $this->view('admin/myadoptions', ['adoptions' => $adoptions]);
    }

    public function profile() {
        $userModel = new UserModel();
        $user = $userModel->getById($_SESSION['user_id']);

        // Passar os dados do usuário para a view
        $this->view('admin/profile', ['user' => $user]);
    }

    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_name' => $_POST['user_name'],
                'email' => $_POST['email'],
                'phone_number' => $_POST['phone_number'],
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Processar a imagem enviada (se houver)
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $data['image'] = $this->uploadImage($_FILES['image'], $_SESSION['user_login']);
            }

            $userModel = new UserModel();
            if ($userModel->update($_SESSION['user_id'], $data)) {
                $this->setFlash('success', 'Perfil atualizado com sucesso!');
            } else {
                $this->setFlash('error', 'Erro ao atualizar perfil.');
            }

            $this->redirect('/admin/profile');
        }
    }

    // Função para processar e salvar a imagem
    private function uploadImage($file, $login) {
        $targetDir = __DIR__ . '/../uploads/';
        $timestamp = date('YmdHis');
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $targetFile = $targetDir . $login . '_' . $timestamp . '.' . $fileExtension;

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return '/uploads/' . $login . '_' . $timestamp . '.' . $fileExtension;
        } else {
            return null; // ou caminho para uma imagem padrão
        }
    }

    // Função para definir mensagem flash
    private function setFlash($type, $message) {
        $_SESSION[$type . '_message'] = $message;
    }

    // Função para redirecionar
    private function redirect($url) {
        header('Location: ' . $url);
        exit();
    }

    // Função para renderizar a view
    private function view($view, $data = []) {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }
}
