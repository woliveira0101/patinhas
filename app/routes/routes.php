<?php

session_start();

require __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\PetController;
use App\Controllers\AdoptionController;
use App\Controllers\DonationController;
use App\Controllers\FormQuestionController;
use App\Controllers\AddressController;
use App\Controllers\PetImageController;
use App\Controllers\AdminController;

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Definir o controlador e ação padrão
$controller = 'HomeController';
$action = 'index';
$id = null;

// Analisar a URI para determinar o controlador, a ação e o ID (se houver)
$parts = explode('/', $uri);

if (!empty($parts[0]) && !empty($parts[1])) {
    $controller = 'App\\Controllers\\' . ucfirst(strtolower($parts[0])) . 'Controller';
    $action = strtolower($parts[1]);
    if (!empty($parts[2])) {
        $id = intval($parts[2]);
    }
} elseif ($uri === '') {
    $controller = 'App\\Controllers\\HomeController';
    $action = 'index';
} elseif ($uri == 'user/register') {
    $controller = 'App\\Controllers\\UserController';
    $action = 'register';
}

// Verificar se o controlador e a ação existem
if (class_exists($controller) && method_exists($controller, $action)) {
    // Se o controlador não for o HomeController e o usuário não estiver logado, e a URI não for para login, autenticação ou registro, redirecionar para a página inicial
    if ($controller !== 'App\\Controllers\\HomeController' && !isset($_SESSION['user_id']) && !in_array($uri, ['user/login', 'user/authenticate', 'user/register'])) {
        header('Location: /');
        exit();
    }
    
    $controllerInstance = new $controller();
    if (in_array($action, ['edit', 'show', 'delete']) && !is_null($id)) {
        $controllerInstance->$action($id);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && in_array($action, ['index', 'create', 'login', 'register', 'dashboard', 'profile'])) {
        $controllerInstance->$action();
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && in_array($action, ['register', 'update', 'authenticate', 'store'])) {
        $data = json_decode(file_get_contents('php://input'), true);
        if (in_array($action, ['store', 'update'])) {
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
        header('HTTP/1.0 404 Not Found');
        echo 'Página não encontrada.';
    }
} else {
    header('HTTP/1.0 404 Not Found');
    echo 'A página não foi encontrada.';
}
