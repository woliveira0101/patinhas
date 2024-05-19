<?php

namespace App\Controllers;

//require __DIR__ . '/../../vendor/autoload.php';
use App\Models\UserModel;

require_once __DIR__ . '/Controller.php';

class UserController extends Controller {

    public function login()
    {
        include __DIR__ . '/../views/include/header.php';
        include __DIR__ . '/../views/users/login.php';
        include __DIR__ . '/../views/include/footer.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['login'];

            // Processar a imagem enviada
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imagePath = $this->uploadImage($_FILES['image'], $login);
            } else {
                $imagePath = null; // ou uma imagem padrão
            }

            $data = [
                'user_name' => $_POST['user_name'],
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
                $this->setFlash('success', 'Usuário registrado com sucesso!');
                $this->redirect('/user/login');
            } else {
                $this->setFlash('error', 'Erro ao registrar usuário.');
                $this->redirect('/user/register');
            }
        }

        $this->view('users/register');
    }

    private function uploadImage($file, $login) {
        $targetDir = "../app/uploads/";
        $timestamp = date('YmdHis');
        $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $newFileName = $login . "_" . $timestamp . "." . $extension;
        $targetFile = $targetDir . $newFileName;

        // Verificar se o arquivo é uma imagem real
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            throw new \Exception("O arquivo não é uma imagem.");
        }

        // Verificar o tamanho do arquivo (opcional)
        if ($file["size"] > 1000000) { // Exemplo: 500KB
            throw new \Exception("Desculpe, o arquivo é muito grande.");
        }

        // Permitir certos formatos de arquivo
        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($extension, $allowedFormats)) {
            throw new \Exception("Desculpe, apenas arquivos JPG, JPEG, PNG e GIF são permitidos.");
        }

        // Tentar mover o arquivo enviado para o diretório de destino
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

            // Redirecionar para o dashboard após login bem-sucedido
            header('Location: /admin/dashboard');
            exit();
        } else {
            // Login falhou, redirecionar de volta para a página de login com uma mensagem de erro
            $_SESSION['error_message'] = 'Login ou senha incorretos';
            header('Location: /user/login');
            exit();
        }
    }

}
