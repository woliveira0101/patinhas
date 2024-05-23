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
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/user/login');
        }

        $userId = $_SESSION['user_id'];
        $donationModel = new DonationModel();
        $donations = $donationModel->getByUserId($userId);

        $this->view('admin/mydonations', ['donations' => $donations]);
    }

    public function myAdoptions() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/user/login');
        }

        $userId = $_SESSION['user_id'];
        $adoptionModel = new AdoptionModel();
        $adoptions = $adoptionModel->getByUserId($userId);

        $this->view('admin/myadoptions', ['adoptions' => $adoptions]);
    }

    // public function profile() {
    //     if (!$this->isLoggedIn()) {
    //         $this->redirect('/user/login');
    //     }

    //     $userId = $this->getUserId();
    //     $userModel = new UserModel();
    //     $user = $userModel->getById($userId, 'user_id');

    //     if ($user) {
    //         $this->view('admin/profile', ['user' => $user]);
    //     } else {
    //         $this->setFlash('error', 'Usuário não encontrado.');
    //         $this->redirect('/user/login');
    //     }
    // }

    // public function updateProfile() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $userModel = new UserModel();
    //         $user = $userModel->getById($_SESSION['user_id'], 'user_id');

    //         $data = [
    //             'user_name' => $_POST['user_name'],
    //             'email' => $_POST['email'],
    //             'phone_number' => $_POST['phone_number'],
    //             'updated_at' => date('Y-m-d H:i:s')
    //         ];

    //         if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    //             $newImagePath = $this->uploadImage($_FILES['image'], $_SESSION['user_login']);
    //             if ($newImagePath) {
    //                 // Delete the old image if it exists
    //                 if (!empty($user['image']) && file_exists(__DIR__ . '/..' . $user['image'])) {
    //                     unlink(__DIR__ . '/..' . $user['image']);
    //                 }
    //                 $data['image'] = $newImagePath;
    //             }
    //         }

    //         if ($userModel->update($_SESSION['user_id'], $data, 'user_id')) {
    //             $this->setFlash('success', 'Perfil atualizado com sucesso!');
    //         } else {
    //             $this->setFlash('error', 'Erro ao atualizar perfil.');
    //         }

    //         $this->redirect('/admin/profile');
    //     }
    // }

    // // Função para processar e salvar a imagem
    // private function uploadImage($file, $login) {
    //     $targetDir = __DIR__ . '/../uploads/';
    //     $timestamp = date('YmdHis');
    //     $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    //     $targetFile = $targetDir . $login . '_' . $timestamp . '.' . $fileExtension;

    //     if (move_uploaded_file($file['tmp_name'], $targetFile)) {
    //         return '/uploads/' . $login . '_' . $timestamp . '.' . $fileExtension;
    //     } else {
    //         return null;
    //     }
    // }

}
