<?php
require_once __DIR__ . '/../controllers/TmdbService.php';

header('Content-Type: application/json');

if (!isset($_GET['movie_id'])) {
    echo json_encode(['error' => 'ID não informado']);
    exit;
}

$movieId = (int) $_GET['movie_id'];

$tmdb = new TmdbService();
$resultado = $tmdb->ondeAssistir($movieId);

echo json_encode([
    'watch' => $resultado
]);