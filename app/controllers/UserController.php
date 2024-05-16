<?php

require_once 'Controller.php';

class UserController extends Controller {
    public function index() {
        // Carrega todos os usuários
        $users = $this->model->getAll();

        // Carrega a view 'users/index' passando os usuários como dados
        $this->view('users/index', ['users' => $users]);
    }

    public function create() {
        // Se o formulário foi submetido
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Processa os dados do formulário
            $formData = $this->processFormData($_POST);

            // Cria um novo usuário com os dados do formulário
            $this->model->create($formData);

            // Redireciona para a página de listagem de usuários
            $this->redirect('/users');
        } else {
            // Carrega a view 'users/create' para exibir o formulário de criação de usuário
            $this->view('users/create');
        }
    }

    public function update($id) {
        // Se o formulário foi submetido
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Processa os dados do formulário
            $formData = $this->processFormData($_POST);

            // Atualiza o usuário com os dados do formulário
            $this->model->update($id, $formData);

            // Redireciona para a página de listagem de usuários
            $this->redirect('/users');
        } else {
            // Carrega os dados do usuário com o ID fornecido
            $user = $this->model->getById($id);

            // Carrega a view 'users/update' passando os dados do usuário
            $this->view('users/update', ['user' => $user]);
        }
    }

    public function delete($id) {
        // Deleta o usuário com o ID fornecido
        $this->model->delete($id);

        // Redireciona para a página de listagem de usuários
        $this->redirect('/users');
    }

    public function login()
    {
        // Implementação do método login
        echo "Página de login";
    }

    public function register()
    {
        // Implementação do método register
        echo "Página de registro";
    }

    public function profile()
    {
        // Implementação do método profile
        echo "Página de perfil do usuário";
    }

}
