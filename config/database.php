<?php

class Database {
        private $host = $_ENV['MYSQLHOST'];
        private $port = $_ENV['MYSQLPORT'];
        private $db   = $_ENV['MYSQLDATABASE'];
        private $user = $_ENV['MYSQLUSER'];
        private $pass = $_ENV['MYSQLPASSWORD'];


    public function connect(){
        try{
            $conn = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->db}",
            $this->user,
            $this->pass);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $conn;
        }catch(PDOException $e){
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}

?>