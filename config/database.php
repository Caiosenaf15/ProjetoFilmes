<?php
class Database {

    private $host;
    private $port;
    private $db;
    private $user;
    private $pass;

    public function __construct() {

        // Detecta se está no Railway
        if (getenv('MYSQLHOST')) {

            // PRODUÇÃO (Railway)
            $this->host = getenv('MYSQLHOST');
            $this->port = getenv('MYSQLPORT');
            $this->db   = getenv('MYSQLDATABASE');
            $this->user = getenv('MYSQLUSER');
            $this->pass = getenv('MYSQLPASSWORD');

        } else {

            // LOCAL
            $this->host = 'localhost';
            $this->port = '3306';
            $this->db   = 'bdfilmes';
            $this->user = 'root';
            $this->pass = '';
        }
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
