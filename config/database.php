<?php
class Database {

    private $host;
    private $port;
    private $db;
    private $user;
    private $pass;

    public function __construct() {

            $this->host = $_ENV['MYSQLHOST'] ?? null;
            $this->port = $_ENV['MYSQLPORT'] ?? null;
            $this->db   = $_ENV['MYSQLDATABASE'] ?? null;
            $this->user = $_ENV['MYSQLUSER'] ?? null;
            $this->pass = $_ENV['MYSQLPASSWORD'] ?? null;
            
    }

    public function connect() {

        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db};charset=utf8mb4";

            $conn = new PDO($dsn, $this->user, $this->pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            return $conn;

        } catch(PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}
