<?php

class Database {
    private $host = 'metro.proxy.rlwy.net';
    private $port = '54051';
    private $db   = 'railway';
    private $user = 'root';
    private $pass = 'EkvKdpTciGkdejlboOnAhXrDeaHNsTJu';

    public function connect(){
        try{
            $conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}",
            $this->username,
            $this->pass);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $conn;
        }catch(PDOException $e){
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}

?>