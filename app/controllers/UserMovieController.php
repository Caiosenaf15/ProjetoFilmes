<?php
require_once __DIR__ . '/../../config/database.php';

$database = new Database();
$pdo = $database->connect();

header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    echo json_encode(["error" => "Usuário não logado"]);
    exit;
}

$userId = (int) $_SESSION['user'];
$movieId = isset($_POST['movie_id']) ? (int) $_POST['movie_id'] : (isset($_GET['movie_id']) ? (int) $_GET['movie_id'] : null);
$action  = $_POST['action'] ?? $_GET['action'] ?? null;
$value   = isset($_POST['value']) ? (int) $_POST['value'] : (isset($_GET['value']) ? (int) $_GET['value'] : null);

// GET: retorna o estado do filme (favorito, assistido, nota)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $movieId) {
    try {
        $stmt = $pdo->prepare("SELECT favorito, assistido, nota FROM user_movies WHERE user_id = ? AND movie_id = ?");
        $stmt->execute([$userId, $movieId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode([
            "is_favorite" => (bool)($row['favorito'] ?? 0),
            "is_watched"  => (bool)($row['assistido'] ?? 0),
            "rating"      => (int)($row['nota'] ?? 0)
        ]);
    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
    exit;
}

if (!$movieId || !$action) {
    echo json_encode(["error" => "Dados inválidos"]);
    exit;
}

try {
    // garante que exista a linha do filme do usuário
    $stmt = $pdo->prepare("SELECT id FROM user_movies WHERE user_id = ? AND movie_id = ?");
    $stmt->execute([$userId, $movieId]);

    if ($stmt->rowCount() === 0) {
        $ins = $pdo->prepare("INSERT INTO user_movies (user_id, movie_id, favorito, assistido) VALUES (?, ?, 0, 0)");
        $ins->execute([$userId, $movieId]);
    }

    switch($action){
        case 'favorite':
            $pdo->prepare("UPDATE user_movies SET favorito = ? WHERE user_id = ? AND movie_id = ?")
                ->execute([$value ? 1 : 0, $userId, $movieId]);
            break;

        case 'watched':
            $pdo->prepare("UPDATE user_movies SET assistido = ? WHERE user_id = ? AND movie_id = ?")
                ->execute([$value ? 1 : 0, $userId, $movieId]);
            break;

        case 'rating':
            $rating = max(1, min(5, (int)$value));
            $pdo->prepare("UPDATE user_movies SET nota = ? WHERE user_id = ? AND movie_id = ?")
                ->execute([$rating, $userId, $movieId]);
            break;
    }

    echo json_encode(["success" => true]);

} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
