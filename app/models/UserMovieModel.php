<?php

class UserMovieModel
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();

    }

    public function handleAction($userId, $movieId, $action, $value = null)
    {
        $stmt = $this->pdo->prepare("
            SELECT id FROM user_movies
            WHERE user_id = ? AND movie_id = ?
        ");
        $stmt->execute([$userId, $movieId]);

        if ($stmt->rowCount() == 0) {
            $this->pdo->prepare("
                INSERT INTO user_movies (user_id, movie_id, favorito, assistido, nota, created_at, updated_at)
                VALUES (?, ?, 0, 0, NULL, NOW(), NOW())
            ")->execute([$userId, $movieId]);
        }

        switch ($action) {

            case 'favorito':
                $stmt = $this->pdo->prepare("
                    SELECT favorito FROM user_movies
                    WHERE user_id = ? AND movie_id = ?
                ");
                $stmt->execute([$userId, $movieId]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $novoValor = ($row['favorito'] == 1) ? 0 : 1;
                $this->pdo->prepare("
                    UPDATE user_movies 
                    SET favorito = ?, updated_at = NOW()
                    WHERE user_id = ? AND movie_id = ?
                ")->execute([$novoValor, $userId, $movieId]);
                break;

            case 'assistido':
                $stmt = $this->pdo->prepare("
                    SELECT assistido FROM user_movies
                    WHERE user_id = ? AND movie_id = ?
                ");
                $stmt->execute([$userId, $movieId]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $novoValor = ($row['assistido'] == 1) ? 0 : 1;
                $this->pdo->prepare("
                    UPDATE user_movies 
                    SET assistido = ?, updated_at = NOW()
                    WHERE user_id = ? AND movie_id = ?
                ")->execute([$novoValor, $userId, $movieId]);
                break;

            case 'nota':
                $nota = (int) $value;
                if ($nota < 1 || $nota > 5) {
                    return;
                }
                $this->pdo->prepare("
                    UPDATE user_movies 
                    SET nota = ?, updated_at = NOW()
                    WHERE user_id = ? AND movie_id = ?
                ")->execute([$nota, $userId, $movieId]);
                break;
        }
    }
    public function getStatus($userId, $movieId){
        $stmt = $this->pdo->prepare("
            SELECT favorito, assistido, nota
            FROM user_movies
            WHERE user_id = ? AND movie_id = ?
        ");

        $stmt->execute([$userId, $movieId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: [
            'favorito' => 0,
            'assistido' => 0,
            'nota' => 0
        ];
    }
}