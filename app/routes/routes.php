<?php

session_start();

require __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\PetController;
use App\Controllers\UserController;
use App\Controllers\AdoptionController;
use App\Controllers\DonationController;
use App\Controllers\FormQuestionController;
use App\Controllers\AddressController;
use App\Controllers\PetImageController;
use App\Controllers\AdminController;
//use App\Controllers\QuestionAnswerController;

// Capturar a URI e remover a barra do início e do fim
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Se o usuário não estiver logado e não estiver acessando a página de login ou registro, redirecioná-lo para a página de login
if (!isset($_SESSION['user_id']) && !in_array($uri, ['user/login', 'user/authenticate', 'user/register'])) {
    header('Location: /user/login');
    exit();
}

// Definir o controlador e ação padrão
$controller = 'App\\Controllers\\PetController';
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
} elseif ($uri == 'user/register') {
    $controller = 'App\\Controllers\\UserController';
    $action = 'register';
}

// Depuração: Imprimir o controlador e a ação
echo "Controller: " . $controller . "<br>";
echo "Action: " . $action . "<br>";

// Verificar se o controlador e a ação existem
if (class_exists($controller) && method_exists($controller, $action)) {
    $controllerInstance = new $controller();

    // Verificar se um ID foi fornecido e passá-lo para os métodos apropriados
    if (in_array($action, ['edit', 'show', 'delete']) && !is_null($id)) {
        $controllerInstance->$action($id);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && in_array($action, ['index', 'create', 'login', 'register', 'dashboard', 'mydonations', 'myadoptions', 'profile'])) {
        $controllerInstance->$action();
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && in_array($action, ['register', 'update', 'authenticate', 'store', 'updateprofile'])) {
        if (in_array($action, ['store', 'update', 'updateprofile'])) {
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
    echo 'A página não foi encontrada.';
}
