<?php
require_once "../config/database.php";

class AuthController {

    public function login() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /login");
            exit;
        }

        $database = new Database();
        $conn = $database->connect();

        $user = trim($_POST['email_user'] ?? '');
        $password = $_POST['password'] ?? '';

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

    public function register() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /register");
            exit;
        }

        $database = new Database();
        $conn = $database->connect();

        $username = trim($_POST['user'] ?? '');
        $dataNascimento = $_POST['dataNascimento'] ?? '';
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($email) || empty($password)) {
            $_SESSION['flash'] = "Preencha todos os campos obrigatórios.";
            header("Location: /register");
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash'] = "Email inválido.";
            header("Location: /register");
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['flash'] = "A senha deve ter no mínimo 6 caracteres.";
            header("Location: /register");
            exit;
        }

        $dataNascimento = $_POST['dataNascimento'] ?? '';

        if (empty($dataNascimento)) {
            $_SESSION['flash'] = "Informe a data de nascimento.";
            header("Location: /register");
            exit;
        }

        $dataNasc = new DateTime($dataNascimento);
        $hoje = new DateTime();
        $idade = $hoje->diff($dataNasc)->y;

        if($idade < 18){
            $_SESSION['flash'] = "Deve ser mais de 18 anos";
            header("Location: /register");
            exit;
        }

        $passHash = password_hash($password, PASSWORD_DEFAULT);

        try {

            $sql = "INSERT INTO users (email, username, idade, senha) 
                    VALUES (:email, :username, :idade, :senha)";

            $stmt = $conn->prepare($sql);

            $stmt->execute([
                ':email' => $email,
                ':username' => $username,
                ':idade' => $idade,
                ':senha' => $passHash
            ]);

            $_SESSION['flash'] = "Conta criada com sucesso!";
            header("Location: /login");
            exit;

        } catch (PDOException $e) {

            $_SESSION['flash'] = "Erro: " . $e->getMessage();

            header("Location: /register");
            exit;
        }
    }
}
