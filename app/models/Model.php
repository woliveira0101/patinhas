<?php

require_once __DIR__ . '/../config/Database.php';

class Model {
    protected $db;
    protected $table;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

}
