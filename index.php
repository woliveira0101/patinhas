<?php

require __DIR__ . '/../vendor/autoload.php';

// Define o caminho base do projeto
define('BASE_PATH', dirname(__DIR__));

// Carrega o arquivo de configuração, se necessário
// require_once BASE_PATH . '/config/config.php';

// Carrega o arquivo de rotas
require_once BASE_PATH . '/app/routes/routes.php';
