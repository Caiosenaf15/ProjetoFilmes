<?php 
require_once __DIR__ . '/../helpers/helper.php';
require_once __DIR__ . '/../controllers/TmdbService.php';

$pesquisa = $_GET['q'] ?? '';
$tmdb = new TmdbService();
$busca = $pesquisa ? $tmdb->buscaFilmes($pesquisa) : [];

ob_start(); 
?>

<style>

body {
    background: #f2f2f7;
    font-family: -apple-system, BlinkMacSystemFont, "San Francisco", sans-serif;
    color: #1c1c1e;
}

/* GRID */

.movies-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    padding: 40px;
    animation: fadeIn 0.6s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

/* CARD */

.movie-card {
    cursor: pointer;
    transition: transform .25s ease;
}

.movie-card:hover {
    transform: scale(1.05);
}

.movie-poster {
    position: relative;
    aspect-ratio: 2/3;
    border-radius: 26px;
    overflow: hidden;
    background: white;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.movie-poster img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-poster {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #e5e5ea, #f2f2f7);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    color: #8e8e93;
}

.movie-rating {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(8px);
    color: white;
    padding: 6px 10px;
    border-radius: 12px;
    font-size: 12px;
}

.movie-title {
    margin-top: 14px;
    font-weight: 600;
    font-size: 15px;
    text-align: center;
}

/* MODAL */

.movie-modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.7);
    backdrop-filter: blur(15px);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    transition: 0.3s ease;
    z-index: 3000;
}

.movie-modal-overlay.active {
    opacity: 1;
    pointer-events: auto;
}

.movie-modal {
    width: 90%;
    max-width: 1000px;
    border-radius: 30px;
    overflow: hidden;
    background: white;
    transform: scale(0.9);
    transition: 0.3s ease;
}

.movie-modal-overlay.active .movie-modal {
    transform: scale(1);
}

/* BACKDROP */

.modal-backdrop {
    height: 300px;
    background-size: cover;
    background-position: center;
    position: relative;
}

.modal-backdrop::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, white 20%, transparent);
}

/* CONTENT */

.modal-body {
    padding: 30px;
    display: flex;
    gap: 30px;
}

.modal-body img {
    width: 250px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.modal-info h2 {
    font-weight: 700;
}

.modal-rating-bar {
    margin: 15px 0;
    height: 8px;
    background: #e5e5ea;
    border-radius: 10px;
    overflow: hidden;
}

.modal-rating-fill {
    height: 100%;
    background: #34c759;
    width: 0%;
    transition: 0.4s ease;
}

.modal-info p {
    color: #555;
}

/* CLOSE */

.close-btn {
    position: absolute;
    right: 20px;
    top: 20px;
    border: none;
    background: rgba(0,0,0,0.4);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
}

/* ACTIONS */

.modal-actions {
    margin-top: 25px;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* BUTTONS IOS */

.action-btn {
    display: flex;
    align-items: center;
    gap: 8px;

    padding: 10px 16px;
    border-radius: 20px;
    border: none;
    background: #f2f2f7;
    cursor: pointer;
    font-weight: 500;
    transition: .25s ease;
}

.action-btn:hover {
    background: #e5e5ea;
    transform: scale(1.02);
}

.action-btn.active {
    background: #007aff;
    color: white;
}

/* STARS */

.rating-stars {
    display: flex;
    gap: 6px;
    font-size: 22px;
    cursor: pointer;
}

.rating-stars span {
    color: #d1d1d6;
    transition: .2s ease;
}

.rating-stars span.active {
    color: #ffcc00;
    transform: scale(1.2);
}


/* RESPONSIVO */

@media (max-width: 768px) {
    .movies-grid { grid-template-columns: repeat(2, 1fr); }
    .modal-body { flex-direction: column; align-items: center; text-align: center; }
}

@media (max-width: 500px) {
    .movies-grid { grid-template-columns: repeat(1, 1fr); }
}

</style>

<?php if (!empty($busca['results'])): ?>

<div class="movies-grid">

<?php foreach ($busca['results'] as $bus): 

    $poster = !empty($bus['poster_path']) 
        ? "https://image.tmdb.org/t/p/w500{$bus['poster_path']}" 
        : null;

    $backdrop = !empty($bus['backdrop_path']) 
        ? "https://image.tmdb.org/t/p/original{$bus['backdrop_path']}"
        : '';

    $rating = number_format($bus['vote_average'], 1, ',', '.');
    $ratingPercent = $bus['vote_average'] * 10; 
?>

<div class="movie-card">
    
    <div class="movie-poster">
        <?php if ($poster): ?>
            <img src="<?= $poster ?>" alt="">
        <?php else: ?>
            <div class="no-poster">🎬</div>
        <?php endif; ?>

        <div class="movie-rating">
            ⭐ <?= $rating ?>
        </div>
    </div>

    <div class="movie-title">
        <?= htmlspecialchars($bus['title']) ?>
    </div>

</div>

<?php endforeach; ?>
</div>

<?php else: ?>
<p style="text-align:center; margin-top:80px;">
    Nenhum filme encontrado para <strong><?= htmlspecialchars($pesquisa) ?></strong>
</p>
<?php endif; ?>


</div>

        </div>

    </div>
</div>


<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>
