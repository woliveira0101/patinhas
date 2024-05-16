<?php

class Database
{
    private static $instance = null;
    private $connection;

    private $host = 'database';
    private $dbname = 'patinhas';
    private $username = 'wellington';
    private $password = 'Univesp2022';

    private function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Erro na conexão com o banco de dados: ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function beginTransaction()
    {
        return $this->connection->beginTransaction();
    }

    public function commit()
    {
        return $this->connection->commit();
    }

    public function rollBack()
    {
        return $this->connection->rollBack();
    }

    public function lastInsertId($name = null)
    {
        return $this->connection->lastInsertId($name);
    }

    public function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }

    public function query($sql)
    {
        return $this->connection->query($sql);
    }

    public function execute($statement)
    {
        return $statement->execute();
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }
}
