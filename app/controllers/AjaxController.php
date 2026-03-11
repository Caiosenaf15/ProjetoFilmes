<?php

require_once __DIR__ . '/TmdbService.php';
require_once __DIR__ . '/../../config/Database.php';

class AjaxController {
    public function providers() {

        header('Content-Type: application/json');

        $movieId = (int) ($_GET['id'] ?? 0);
        if (!$movieId) {
            echo json_encode([]);
            return;
        }

        $cacheDir = __DIR__ . '/../cache/';
        $cacheFile = $cacheDir . "providers_$movieId.json";

        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }

        if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 21600) {
            echo file_get_contents($cacheFile);
            return;
        }

        $tmdb = new TmdbService();
        $providers = $tmdb->ondeAssistir($movieId);

        file_put_contents($cacheFile, json_encode($providers));

        echo json_encode($providers);
    }

   public function userMovieAction()
    {
        header('Content-Type: application/json');

        if (!isset($_SESSION['user'])) {
            echo json_encode(['success' => false, 'error' => 'Não autenticado']);
            exit;
        }

        $userId  = $_SESSION['user'];
        $movieId = $_POST['movie_id'] ?? null;
        $action  = $_POST['action'] ?? null;
        $value   = $_POST['value'] ?? null;

        if (!$movieId || !$action) {
            echo json_encode(['success' => false]);
            exit;
        }

        require_once __DIR__ . '/../models/UserMovieModel.php';
        $model = new UserMovieModel();

        $model->handleAction($userId, $movieId, $action, $value);

        echo json_encode(['success' => true]);
    }

    public function getUserMovieStatus(){
        header('Content-Type: application/json');

        $userId = $_SESSION['user'] ?? null;

        if (!$userId) {
            echo json_encode(['success' => false]);
            exit;
        }

        $movieId = $_GET['id'] ?? null;

        require_once __DIR__ . '/../models/UserMovieModel.php';
        $model = new UserMovieModel();

        $data = $model->getStatus($userId, $movieId);

        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    }
}