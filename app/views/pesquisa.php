<?php 
require_once __DIR__ . '/../helpers/helper.php';
require_once __DIR__ . '/../controllers/TmdbService.php';

$pesquisa = $_GET['q'] ?? '';
$tmdb = new TmdbService();
$busca = $pesquisa ? $tmdb->buscaFilmes($pesquisa) : [];
$filmes = $busca['results'] ?? [];
$totalPages = $busca['total_pages'] ?? 1;

$showFilters = true;

ob_start();
require __DIR__ . '/../partials/movie_list.php';
?>


<?php if (!empty($busca['results'])): ?>

<?php else: ?>
<p style="text-align:center; margin-top:80px;">
    Nenhum filme encontrado para <strong><?= htmlspecialchars($pesquisa) ?></strong>
</p>
<?php endif; ?>


<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>
