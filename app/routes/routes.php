<?php

// Importa os controladores necessários
require_once __DIR__ . '/../controllers/UserController.php';

// Rotas
$uri = $_SERVER['REQUEST_URI'];

// Rota para a página inicial
if ($uri === '/' || $uri === '/index.php') {
    // Exibe a página inicial (pode ser substituída pela página desejada)
    echo "Bem-vindo à página inicial!";
} 
// Rota para a página de login
elseif ($uri === '/login') {
    $userController = new UserController();
    $userController->login();
}
// Rota para a página de registro
elseif ($uri === '/register') {
    $userController = new UserController();
    $userController->register();
} 
// Rota para a página de perfil do usuário
elseif ($uri === '/profile') {
    $userController = new UserController();
    $userController->profile();
}
// Rota padrão para páginas não encontradas
else {
    http_response_code(404);
    echo "Página não encontrada";
}
