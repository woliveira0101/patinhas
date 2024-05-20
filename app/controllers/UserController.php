<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AddressModel;

require_once __DIR__ . '/Controller.php';

class UserController extends Controller {

    public function login() {
        include __DIR__ . '/../views/users/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['login'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imagePath = $this->uploadImage($_FILES['image'], $login);
            } else {
                $imagePath = null;
            }

            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone_number' => $_POST['phone_number'],
                'login' => $login,
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'type' => $_POST['type'],
                'is_active' => true,
                'image' => $imagePath,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $userModel = new UserModel();
            if ($userModel->create($data)) {
                $_SESSION['user_id'] = $userModel->getLastInsertId();
                $_SESSION['user_login'] = $login;
                $_SESSION['user_type'] = $_POST['type'];

                $redirectUrl = $this->getFlash('redirect_after_login') ?? '/user/address';
                $this->redirect($redirectUrl);
            } else {
                $this->setFlash('error', 'Erro ao registrar usuário.');
                $this->redirect('/user/register');
            }
        }

        if (isset($_GET['address'])) {
            $this->view('address/registration');
        } else {
            $this->view('users/register');
        }
    }

    private function uploadImage($file, $login) {
        $targetDir = __DIR__ . '/../../public/assets/img/profiles/';
        $timestamp = date('YmdHis');
        $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $newFileName = $login . "_" . $timestamp . "." . $extension;
        $targetFile = $targetDir . $newFileName;

        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            throw new \Exception("O arquivo não é uma imagem.");
        }

        if ($file["size"] > 1000000) {
            throw new \Exception("Desculpe, o arquivo é muito grande.");
        }

        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($extension, $allowedFormats)) {
            throw new \Exception("Desculpe, apenas arquivos JPG, JPEG, PNG e GIF são permitidos.");
        }

        if (!move_uploaded_file($file["tmp_name"], $targetFile)) {
            throw new \Exception("Desculpe, ocorreu um erro ao fazer upload do arquivo.");
        }

        return $newFileName;
    }

    public function authenticate() {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $userModel = new UserModel();
        $user = $userModel->authenticate($login, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_login'] = $user['login'];
            $_SESSION['user_type'] = $user['type'];

            header('Location: /admin/dashboard');
            exit();
        } else {
            $_SESSION['error_message'] = 'Login ou senha incorretos';
            header('Location: /user/login');
            exit();
        }
    }

    public function profile() {
        if (!$this->isLoggedIn()) {
            $this->redirect('/user/login');
        }

        $userId = $this->getUserId();
        $userModel = new UserModel();
        $user = $userModel->getById($userId, 'user_id');

        if ($user) {
            $this->view('users/profile', ['user' => $user]);
        } else {
            $this->setFlash('error', 'Usuário não encontrado.');
            $this->redirect('/user/login');
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new UserModel();
            $user = $userModel->getById($_SESSION['user_id'], 'user_id');
    
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone_number' => $_POST['phone_number'],
                'type' => $_POST['type'],
                'updated_at' => date('Y-m-d H:i:s')
            ];
    
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $newImagePath = $this->uploadImage($_FILES['image'], $_SESSION['user_login']);
                if ($newImagePath) {
                    if (!empty($user['image']) && file_exists(__DIR__ . '/../../public/assets/img/profiles/' . $user['image'])) {
                        unlink(__DIR__ . '/../../public/assets/img/profiles/' . $user['image']);
                    }
                    $data['image'] = $newImagePath;
                }
            }

            if ($userModel->update($_SESSION['user_id'], $data, 'user_id')) {
                $this->setFlash('success', 'Perfil atualizado com sucesso!');
            } else {
                $this->setFlash('error', 'Erro ao atualizar perfil.');
            }

            $this->redirect('/user/profile');
        }
    }

    public function address() {
        $this->view('address/registration');
    }
}
