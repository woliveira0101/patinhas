<?php
namespace App\Config;

require __DIR__ . '/../../vendor/autoload.php';


use PDO;
use PDOException;

class Database {
    private $host = 'database';
    private $db_name = 'patinhas';
    private $username = 'wellington';
    private $password = 'Univesp2022';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
