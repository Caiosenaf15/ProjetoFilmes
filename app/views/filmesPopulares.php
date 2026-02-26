<?php 
require_once __DIR__ . '/../helpers/helper.php';
require_once __DIR__ . '/../controllers/TmdbService.php';

$page  = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$adult = isset($_GET['adult']) ? $_GET['adult'] : 'false';
$order = isset($_GET['order']) ? $_GET['order'] : 'desc';

ob_start(); 
?>

<style>

body {
    background: #f2f2f7;
    font-family: -apple-system, BlinkMacSystemFont, "San Francisco", sans-serif;
    color: #1c1c1e;
}


.filter-bar {
    width: 90%;
    max-width: 900px;
    margin: 40px auto;
    padding: 20px 25px;
    border-radius: 28px;
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(25px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    display: flex;
    justify-content: space-between;
    align-items: center;
}


.switch {
    position: relative;
    display: inline-block;
    width: 52px;
    height: 30px;
}

.switch input { display: none; }

.slider {
    position: absolute;
    cursor: pointer;
    inset: 0;
    background-color: #e5e5ea;
    border-radius: 30px;
    transition: .3s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 2px;
    top: 2px;
    background-color: white;
    border-radius: 50%;
    transition: .3s;
    box-shadow: 0 3px 6px rgba(0,0,0,0.2);
}

input:checked + .slider {
    background-color: #34c759; /* verde iOS */
}

input:checked + .slider:before {
    transform: translateX(22px);
}


.segmented {
    display: flex;
    background: #e5e5ea;
    border-radius: 12px;
    padding: 3px;
}

.segmented button {
    border: none;
    padding: 8px 16px;
    font-weight: 500;
    border-radius: 10px;
    background: transparent;
    cursor: pointer;
    transition: .2s;
}

.segmented .active {
    background: white;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}


.movies-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    padding: 40px;
}


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

/* Modal */

.modal-background {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 1000;
    background-color: rgba(0,0,0,0.7);
    justify-content: center;
    align-items: center;
}

.modal-body {
    position: relative;
    height: 80vh;
    width: 70vw;
    max-width: 900px;
    background: white;
    border-radius: 20px;
    overflow: hidden;
}

.btn-close-modal {
    position: absolute;
    top: 15px;
    right: 20px;
    width: 45px;
    height: 45px;
    border: none;
    border-radius: 50%;
    font-size: 20px;
    cursor: pointer;
    z-index: 10;
}

.modal-poster {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.modal-poster img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.modal-poster::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        transparent 30%,
        rgba(255,255,255,0.3) 60%,
        rgba(255,255,255,0.6) 75%,
        white 100%
    );
    z-index: 2;
}
.modal-content {
    padding: 30px;
}

.modal-content h2 {
    margin: 0 0 10px;
}

.modal-rating {
    font-weight: bold;
    margin-bottom: 15px;
}

.modal-actions {
    position: absolute;
    bottom: 20px;
    right: 25px;

    display: flex;
    gap: 12px;
}

.modal-actions button {
    width: 60px;
    height: 60px;
    border: none;
    border-radius: 15px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.2s ease;
}

/* botão favorito */
.btn-fav {
    padding: 15px;
    background-color: #00000020;
}

.btn-fav:hover {
    transform: scale(1.05);
}

/* botão assistido */
.btn-watch {
    padding: 15px;
    background-color: #00000020;
}

.btn-watch:hover {
    transform: scale(1.05);
}

/* Action */
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


.pagination {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin: 50px 0;
}

.page-btn {
    padding: 8px 14px;
    border-radius: 14px;
    border: 1px solid #e5e5ea;
    background: white;
    font-size: 14px;
    cursor: pointer;
    transition: .2s;
}

.page-btn:hover {
    background: #f2f2f7;
}

.page-active {
    background: #007aff;
    color: white;
    border: none;
}

.no-poster {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #e5e5ea, #f2f2f7);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-size: 28px;
    color: #8e8e93;
    text-align: center;
}


@media (max-width: 1024px) {
    .movies-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
    .movies-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 500px) {
    .movies-grid { grid-template-columns: repeat(1, 1fr); }
}

</style>

<?php
$tmdb = new TmdbService();
$populares = $tmdb->filmesPopulares($page, $adult, $order);
?>

<div class="filter-bar">

    <div>
        <strong id='teste'>NSFW</strong><br>
        <label class="switch">
            <input type="checkbox" id="adultSwitch" <?= $adult === 'true' ? 'checked' : '' ?>>
            <span class="slider"></span>
        </label>
    </div>

    <div>
        <strong>Ordenação</strong><br>
        <div class="segmented">
            <button id="descBtn" class="<?= $order === 'desc' ? 'active' : '' ?>">Recentes</button>
            <button id="ascBtn"  class="<?= $order === 'asc' ? 'active' : '' ?>">Antigos</button>
        </div>
    </div>

</div>

<div class="movies-grid">
    <?php foreach ($populares['results'] as $pop): 

        $poster = !empty($pop['poster_path']) 
            ? "https://image.tmdb.org/t/p/w500{$pop['poster_path']}" 
            : null;

        $backdrop = !empty($pop['backdrop_path']) 
            ? "https://image.tmdb.org/t/p/original{$pop['backdrop_path']}"
            : '';

        $rating = number_format($pop['vote_average'], 1, ',', '.');

    ?>
        <div class="movie-card"
            onclick="modalOpen(
                '<?= $backdrop ?>',
                '<?= htmlspecialchars(addslashes($pop['title'])) ?>',
                '<?= htmlspecialchars(addslashes($pop['overview'])) ?>',
                '<?= $rating ?>',
                '<?= htmlspecialchars(addslashes($tmdb->ondeAssistir($pop['id']))) ?>'

            )">

            <div class="movie-poster">
                <?php if ($poster): ?>
                    <img src="<?= $poster ?>" alt="">
                <?php endif; ?>

                <div class="movie-rating">
                    ⭐ <?= $rating ?>
                </div>
            </div>

            <div class="movie-title">
                <?= htmlspecialchars($pop['title']) ?>
            </div>
        </div>

    <?php endforeach; ?>
</div>

<div class="modal-background" id="modal-background" onclick="closeModal(event)">
    <div class="modal-body">

        <button class="btn-close-modal" onclick="closeModal()">✕</button>

        <div class="modal-poster">
            <img id="modal-img" src="" alt="">
        </div>

        <div class="modal-content">
            <h2 id="modal-title"></h2>
            <div class="modal-rating">⭐ <span id="modal-rating"></span></div>
            <p id="modal-overview"></p>
        </div>

        <div class="modal-card-streams">
            <span id="modal-streams"></span>
        </div>

        <div class="modal-actions">
            <button class="btn-fav">
                <svg xmlns="http://www.w3.org/2000/svg" width='25px' height='25px' fill="black" class="bi bi-star" viewBox="0 0 16 16">
                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                </svg>
            </button>
            <button class="btn-watch">
                <svg xmlns="http://www.w3.org/2000/svg" width='25px' height='25px' fill="black" class="bi bi-eye" viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                </svg>
            </button>
        </div>
    </div>
</div>


<?php
$totalPages = $populares['total_pages'];
$maxLinks = 5;
$start = max(1, $page - 2);
$end = min($totalPages, $start + $maxLinks - 1);
?>

<div class="pagination">
<?php for ($i = $start; $i <= $end; $i++): ?>
    <a href="?page=<?= $i ?>&adult=<?= $adult ?>&order=<?= $order ?>">
        <div class="page-btn <?= $i == $page ? 'page-active' : '' ?>">
            <?= $i ?>
        </div>
    </a>
<?php endfor; ?>
</div>


<script>
let modalStatus = false;

function updateFilters(newAdult = null, newOrder = null) {
    const url = new URL(window.location.href);

    if (newAdult !== null)
        url.searchParams.set('adult', newAdult);

    if (newOrder !== null)
        url.searchParams.set('order', newOrder);

    url.searchParams.set('page', 1);

    window.location.href = url.toString();
}

function modalOpen(backdrop, title, overview, rating, stream) {

    document.getElementById("modal-img").src = backdrop;
    document.getElementById("modal-title").innerText = title;
    document.getElementById("modal-overview").innerText = overview;
    document.getElementById("modal-rating").innerText = rating;
    document.getElementById("modal-background").style.display = "flex";
    document.getElementById("modal-streams").innerText = stream;
}

function closeModal(event) {

    if (event && event.target !== event.currentTarget) {
        return;
    }

    document.getElementById("modal-background").style.display = "none";
}

</script>

<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>
