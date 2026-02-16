<?php

class Database {

    private $host;
    private $port;
    private $db;
    private $user;
    private $pass;

    public function __construct() {
        $this->host = $_ENV['MYSQLHOST'];
        $this->port = $_ENV['MYSQLPORT'];
        $this->db   = $_ENV['MYSQLDATABASE'];
        $this->user = $_ENV['MYSQLUSER'];
        $this->pass = $_ENV['MYSQLPASSWORD'];
    }

    public function connect() {
        try {
            $conn = new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->db}",
                $this->user,
                $this->pass
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;

        } catch(PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}
