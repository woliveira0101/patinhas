<?php

session_start();

require __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\AddressController;
use App\Controllers\AdminController;
use App\Controllers\AdoptionController;
use App\Controllers\DonationController;
use App\Controllers\HomeController;
use App\Controllers\PetController;
use App\Controllers\PetImageController;
use App\Controllers\UserController;

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$controller = 'HomeController';
$action = 'index';
$id = null;
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
} elseif ($uri == 'pets') {
    $controller = 'App\\Controllers\\PetController';
    $action = 'index';
}

if (class_exists($controller) && method_exists($controller, $action)) {
    if ($controller !== 'App\\Controllers\\HomeController' && !isset($_SESSION['user_id']) && !in_array($uri, ['user/login', 'user/authenticate', 'user/register'])) {
        header('Location: /');
        exit();
    }

    $controllerInstance = new $controller();
    // Log para depuração
    // print_r("Controller: $controller, Action: $action, ID: " . ($id ?? 'null'));

    if (in_array($action, ['edit', 'show', 'delete', 'update', 'request', 'cancel', 'showrequests']) && !is_null($id)) {
        $controllerInstance->$action($id);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && in_array($action, ['index', 'create', 'login', 'register', 'dashboard', 'profile', 'mydonations', 'myadoptions', 'address', 'list', 'registration', 'request', 'success'])) {
        $controllerInstance->$action();
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && in_array($action, ['register', 'update', 'authenticate', 'store', 'updatestatus'])) {
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
