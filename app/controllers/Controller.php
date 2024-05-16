<?php

class Controller {
    protected $model;

    public function __construct() {
        $this->model = $this->loadModel();
    }

    protected function loadModel() {
        $modelName = str_replace('Controller', 'Model', get_class($this));
        $modelFile = '../app/models/' . $modelName . '.php';

        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $modelName();
        } else {
            return null;
        }
    }

    protected function view($view, $data = []) {
        $viewFile = '../app/views/' . $view . '.php';
        if (file_exists($viewFile)) {
            extract($data);
            require_once $viewFile;
        } else {
            die('View does not exist');
        }
    }

    protected function redirect($url) {
        header('Location: ' . $url);
        exit();
    }

    protected function processFormData($formData) {
        // Implemente aqui a lógica para processar os dados do formulário
    }

    protected function authenticateUser($username, $password) {
        // Implemente aqui a lógica para autenticar o usuário
    }

    protected function logout() {
        // Implemente aqui a lógica para fazer logout do usuário
    }

    protected function startSession() {
        session_start();
    }

    protected function destroySession() {
        session_destroy();
    }

    protected function formatDate($date) {
        return date('Y-m-d', strtotime($date));
    }

    protected function sanitizeString($string) {
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

}
