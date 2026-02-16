<?php

class Database {
        $host = $_ENV['MYSQLHOST'];
        $port = $_ENV['MYSQLPORT'];
        $db   = $_ENV['MYSQLDATABASE'];
        $user = $_ENV['MYSQLUSER'];
        $pass = $_ENV['MYSQLPASSWORD'];


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