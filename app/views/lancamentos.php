<?php 
require_once __DIR__ . '/../helpers/helper.php';
require_once __DIR__ . '/../controllers/TmdbService.php';

$page  = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$adult = isset($_GET['adult']) ? $_GET['adult'] : 'false';
$order = isset($_GET['order']) ? $_GET['order'] : 'desc';

$tmdb = new TmdbService();

$response = $tmdb->futurosLancamentos($page, $adult, $order);

$filmes = $response['results'] ?? [];
$totalPages = $response['total_pages'] ?? 1;

$showFilters = true;

ob_start();
require __DIR__ . '/../partials/movie_list.php';
?>


<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>
