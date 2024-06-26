<?php

session_start();

require_once __DIR__ . '/../config/Database.php';

require_once __DIR__ . '/../models/Model.php';
require_once __DIR__ . '/../models/AdoptionModel.php';
require_once __DIR__ . '/../models/PetImageModel.php';
require_once __DIR__ . '/../models/AddressModel.php';
require_once __DIR__ . '/../models/PetModel.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/DonationModel.php';
require_once __DIR__ . '/../models/QuestionModel.php';

require_once __DIR__ . '/../controllers/Controller.php';
require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/AddressController.php';
require_once __DIR__ . '/../controllers/AdminController.php';
require_once __DIR__ . '/../controllers/PetController.php';
require_once __DIR__ . '/../controllers/PetImageController.php';
require_once __DIR__ . '/../controllers/DonationController.php';
require_once __DIR__ . '/../controllers/AdoptionController.php';

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\AddressController;
use App\Controllers\AdminController;
use App\Controllers\PetController;
use App\Controllers\DonationController;
use App\Controllers\AdoptionController;

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$controller = 'HomeController';
$action = 'index';
$id = null;
$parts = explode('/', $uri);

if (!empty($parts[0]) && !empty($parts[1])) {
    $controller = ucfirst(strtolower($parts[0])) . 'Controller';
    $action = strtolower($parts[1]);
    if (!empty($parts[2])) {
        $id = intval($parts[2]);
    }
} elseif ($uri === '') {
    $controller = 'HomeController';
    $action = 'index';
} elseif ($uri == 'user/register') {
    $controller = 'UserController';
    $action = 'register';
} elseif ($uri == 'pets') {
    $controller = 'PetController';
    $action = 'index';
}

if (class_exists("App\\Controllers\\$controller") && method_exists("App\\Controllers\\$controller", $action)) {
    // Verificação de sessão para páginas que não são Home, Pet e User actions permitidas
    if (!in_array($controller, ['PetController', 'HomeController']) && !isset($_SESSION['user_id']) && !in_array($uri, ['user/login', 'user/authenticate', 'user/register', 'user/checksession'])) {
        header('Location: /');
        exit();
    }

    $controllerClass = "App\\Controllers\\$controller";
    $controllerInstance = new $controllerClass();
    if (in_array($action, ['edit', 'show', 'delete', 'update', 'request', 'cancel', 'showrequests']) && !is_null($id)) {
        $controllerInstance->$action($id);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && in_array($action, ['index', 'create', 'login', 'register', 'dashboard', 'profile', 'mydonations', 'myadoptions', 'address', 'list', 'registration', 'request', 'success', 'checksession'])) {
        $controllerInstance->$action();
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && in_array($action, ['register', 'update', 'authenticate', 'store', 'updatestatus', 'changepassword'])) {
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