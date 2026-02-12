<?php

class Database {

mysql -h metro.proxy.rlwy.net -u root -p EkvKdpTciGkdejlboOnAhXrDeaHNsTJu --port 54051 --protocol=TCP railway
    $host = 'metro.proxy.rlwy.net';
    $port = '54051';
    $db   = 'railway';
    $user = 'root';
    $pass = 'EkvKdpTciGkdejlboOnAhXrDeaHNsTJu';

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