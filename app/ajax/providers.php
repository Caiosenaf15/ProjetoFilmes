<?php
require_once __DIR__ . '/../controllers/TmdbService.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode([]);
    exit;
}

$movieId = (int) $_GET['id'];

$tmdb = new TmdbService();


$cacheDir = __DIR__ . '/../cache/';
$cacheFile = $cacheDir . "providers_{$movieId}.json";

if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0777, true);
}

$cacheTime = 60 * 60 * 6;

if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTime) {
    echo file_get_contents($cacheFile);
    exit;
}

$providers = $tmdb->ondeAssistir($movieId);

file_put_contents($cacheFile, json_encode($providers));

echo json_encode($providers);