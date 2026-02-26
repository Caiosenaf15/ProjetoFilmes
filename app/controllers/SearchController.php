<?php
require_once __DIR__ . "/../../config/database.php";

class SearchController {

    public function pesquisa() {

        $database = new Database();
        $conn = $database->connect();

        $sql = "SELECT id, username, senha FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $user);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['senha'])) {

            session_regenerate_id(true);

            $_SESSION['user'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            $_SESSION['flash'] = "Login realizado com sucesso!";
            header("Location: /");
            exit;

        } else {
            $_SESSION['flash'] = "Usuário ou senha inválidos!";
            header("Location: /login");
            exit;
        }
    }
}