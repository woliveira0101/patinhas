<?php

namespace App\Controllers;

//require __DIR__ . '/../../vendor/autoload.php';
use App\Models\UserModel;

require_once __DIR__ . '/Controller.php';

class UserController extends Controller {

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'user_name' => $_POST['user_name'],
                'email' => $_POST['email'],
                'phone_number' => $_POST['phone_number'],
                'login' => $_POST['login'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'type' => $_POST['type'],
                'is_active' => true,
                'image' => isset($_POST['image']) ? $_POST['image'] : null
            ];

            $userModel = new UserModel();
            if ($userModel->create($data)) {
                $this->setFlash('success', 'Usuário registrado com sucesso!');
                $this->redirect('/login');
            } else {
                $this->setFlash('error', 'Erro ao registrar usuário.');
                $this->redirect('/register');
            }
        }

        $this->view('users/register');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['user_id'] = $user['user_id'];
                $this->redirect('/dashboard');
            } else {
                $this->setFlash('error', 'Email ou senha inválidos.');
                $this->redirect('/login');
            }
        }

        $this->view('users/login');
    }

    public function logout() {
        if (!isset($_SESSION)) {
            session_start();
        }
        session_destroy();
        $this->redirect('/login');
    }
}
