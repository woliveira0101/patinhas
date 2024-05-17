<?php

namespace App\Controllers;

//require __DIR__ . '/../../vendor/autoload.php';

class Controller {
    // Método para renderizar uma view
    protected function view($view, $data = []) {
        extract($data);
        require_once "../app/views/$view.php";
    }

    // Método para redirecionar para outra URL
    protected function redirect($url) {
        header("Location: $url");
        exit();
    }

    // Método para definir uma mensagem de sessão (flash message)
    protected function setFlash($name, $message) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION[$name] = $message;
    }

    // Método para obter uma mensagem de sessão (flash message) e removê-la
    protected function getFlash($name) {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION[$name])) {
            $message = $_SESSION[$name];
            unset($_SESSION[$name]);
            return $message;
        }
        return null;
    }

    // Método para verificar se o usuário está logado
    protected function isLoggedIn() {
        if (!isset($_SESSION)) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    // Método para obter o ID do usuário logado
    protected function getUserId() {
        if ($this->isLoggedIn()) {
            return $_SESSION['user_id'];
        }
        return null;
    }
}
