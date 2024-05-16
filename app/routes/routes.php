<?php
session_start();

// Carregar arquivos de configuração e classes necessárias
require_once __DIR__ . '/../controllers/UserController.php';
// require_once __DIR__ . '/../controllers/PetController.php';
// require_once __DIR__ . '/../controllers/AdoptionController.php';
// require_once __DIR__ . '/../controllers/DonationController.php';
// require_once __DIR__ . '/../controllers/FormQuestionController.php';

// Capturar a URI e remover a barra do início e do fim
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Se o usuário não estiver logado e não estiver acessando a página de login ou registro, redirecioná-lo para a página de login
if (!isset($_SESSION['user_id']) && !in_array($uri, ['users/login', 'users/authenticate', 'users/register'])) {
    header('Location: /users/login');
    exit();
}

// Definir o controlador e ação padrão
$controller = 'PropertiesController';
$action = 'index';
$id = null;

// Analisar a URI para determinar o controlador, a ação e o ID (se houver)
$parts = explode('/', $uri);

if (!empty($parts[0]) && !empty($parts[1])) {
    $controller = ucfirst(strtolower($parts[0])) . 'Controller';
    $action = strtolower($parts[1]);
    if (!empty($parts[2])) {
        $id = intval($parts[2]);
    }
} elseif ($uri == 'users/register') {
    $controller = 'UsersController';
    $action = 'register';
}

// Verificar se o controlador e a ação existem
if (class_exists($controller) && method_exists($controller, $action)) {
    $controllerInstance = new $controller();

    // Verificar se um ID foi fornecido e passá-lo para os métodos apropriados
    if (in_array($action, ['edit', 'show', 'delete']) && !is_null($id)) {
        $controllerInstance->$action($id);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && in_array($action, ['index', 'create', 'login', 'register'])) {
        $controllerInstance->$action();
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && in_array($action, ['register', 'update', 'authenticate', 'store'])) {
        if (in_array($action, ['store', 'update'])) {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($action == 'update' && !is_null($id)) {
                $controllerInstance->$action($id, $data);
            } else {
                $controllerInstance->$action($data);
            }
        } else {
            $controllerInstance->$action();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE' && in_array($action, ['delete']) && !is_null($id)) {
        $controllerInstance->$action($id);
    } elseif (in_array($action, ['logout'])) {
        $controllerInstance->$action();
    } else {
        // Enviar resposta de erro 404 (página não encontrada)
        header('HTTP/1.0 404 Not Found');
        echo 'Página não encontrada.';
    }
} else {
    // Enviar resposta de erro 404 (página não encontrada)
    header('HTTP/1.0 404 Not Found');
    echo 'Página não encontrada.';
}
