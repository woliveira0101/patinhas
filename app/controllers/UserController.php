<?php
//var_dump($_POST);
require_once 'Controller.php';

class UserController extends Controller {

    public function index() {

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
        //include __DIR__ . '/../views/partials/header.php';
        include_once __DIR__ . '/../views/users/login.php';
        //include __DIR__ . '/../views/partials/footer.php';
    }

    public function authenticate()
    {
        // Implementação do método login
        //echo "Página de login";
        // Verificar se o formulário de login foi submetido
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_name'])) {
            // Obter dados do formulário
            $username = $_POST['user_name'];
            $password = $_POST['password'];
            //echo $password;
            // Verificar se o usuário existe e as credenciais estão corretas
            //$user = $this->model->authenticate($username, $password);
            $user = UserModel::authenticate($username, $password);
            
            if ($user && password_verify($password, $user->getPassword())) {
                // Autenticar usuário e redirecionar para a página inicial
                $_SESSION['user_id'] = $user->getUserid();
                header('Location: /');
                exit();
            } else {
                // Exibir mensagem de erro de login
                echo 'Credenciais inválidas. Por favor, tente novamente.';
            }
        } else {
            // Exibir formulário de login
            include_once __DIR__ . '/../views/users/login.php';
        }
    }

    public function register()
    {
        // Implementação do método register
        // echo "Página de registro";
            // Verificar se o formulário de registro foi submetido
            //var_dump($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
        // Obter dados do formulário
        $userData = [
            'user_name' => $_POST['user_name'],
            'email' => $_POST['email'],
            'phone_number' => $_POST['phone_number'],
            'login' => $_POST['login'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Hash da senha
            'type' => isset($_POST['type']) ? $_POST['type'] : null,
            'is_active' => true, // Definir como ativo por padrão
        ];
        
        // Verificar se uma imagem foi enviada
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Diretório de upload
            $uploadDir = __DIR__ . '/../uploads/';

            // Extensão do arquivo
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            // Novo nome do arquivo
            $newFilename = $userData['login'] . '_' . date('YmdHis') . '.' . $ext;

            // Caminho completo para o arquivo de destino
            $uploadFile = $uploadDir . $newFilename;

            // Mover a imagem carregada para o diretório de upload
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                // Adicionar o caminho da imagem aos dados do usuário
                $userData['image'] = 'uploads/' . $newFilename;
            } else {
                // Exibir mensagem de erro se o upload da imagem falhar
                echo 'Erro ao fazer upload da imagem.';
                exit();
            }
        }
        
        // Chamar o método do UserModel para registrar o usuário
        $userId = $this->model->createUser($userData);

        if ($userId) {
            // Redirecionar para a página de login após o registro bem-sucedido
            header('Location: /users/login');
            exit();
        } else {
            // Exibir mensagem de erro se o registro falhar
            echo 'O registro falhou. Por favor, tente novamente.';
        }
    } else {
        // Exibir formulário de registro
        include_once __DIR__ . '/../views/users/register.php';
    }
    }

    public function profile()
    {
        // Implementação do método profile
        echo "Página de perfil do usuário";
    }

}
