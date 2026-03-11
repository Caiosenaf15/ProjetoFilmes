<?php 
require_once __DIR__ . '/../../config/database.php';

class favController{

    public function favoritos() {

        $database = new Database();
        $conn = $database->connect();

        if(isset($_SESSION['user'])){
            
            $id = $_SESSION['user'] ?? '';
            var_dump($id);
            die();
            
        }
        

        $sql = "SELECT movie_id, favorito FROM user_movies WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $id);
        $stmt->execute();
        $DataFavoritos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        

        return $DataFavoritos;
    }
}

?>