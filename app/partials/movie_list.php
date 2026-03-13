<style>

body {
    background: #f2f2f7;
    font-family: -apple-system, BlinkMacSystemFont, "San Francisco", sans-serif;
    color: #1c1c1e;
}

.genre_title {
    text-align: center;
    font-size: 36px;
    font-weight: bold;
    margin: 30px 0;
    position: relative;
}

.genre_title::after {
    content: "";
    width: 80px;
    height: 3px;
    background: red;
    display: block;
    margin: 10px auto 0;
}

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
    background: rgba(255,255,255,0.96);
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 24px 70px rgba(0,0,0,0.35);
    font-family: -apple-system, BlinkMacSystemFont, "San Francisco", "Segoe UI", Roboto, Arial, sans-serif;
    display: flex;
    flex-direction: column;
}

.btn-close-modal {
    position: absolute;
    top: 15px;
    right: 20px;
    width: 40px;
    height: 40px;
    border: 1px solid rgba(60,60,67,0.18);
    border-radius: 999px;
    font-size: 18px;
    cursor: pointer;
    z-index: 10;
    background: rgba(242,242,247,0.85);
    backdrop-filter: blur(20px) saturate(180%);
    color: #1c1c1e;
    box-shadow: 0 10px 24px rgba(0,0,0,0.14);
    transition: transform 0.18s ease, background 0.18s ease;
}

.btn-close-modal:hover {
    transform: translateY(-1px);
    background: rgba(242,242,247,0.95);
}

.btn-close-modal:active {
    transform: scale(0.98);
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
    padding: 0;
}

.modal-content h2 {
    margin: 0 0 10px;
}

#modal-streams{
    padding: 0;
}

.modal-scroll {
    flex: 1 1 auto;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    padding: 22px 24px 18px;
}

.modal-scroll::-webkit-scrollbar {
    width: 10px;
}
.modal-scroll::-webkit-scrollbar-thumb {
    background: rgba(60,60,67,0.22);
    border-radius: 999px;
    border: 3px solid rgba(255,255,255,0);
    background-clip: padding-box;
}

.modal-rating {
    font-weight: bold;
    margin-bottom: 15px;
}

.modal-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;

    padding: 12px 14px;
    margin: 14px 16px 16px;
    border-radius: 22px;
    background: rgba(242,242,247,0.84);
    backdrop-filter: blur(28px) saturate(180%);
    border: 1px solid rgba(60,60,67,0.18);
    box-shadow: 0 16px 34px rgba(0,0,0,0.16);
}

.modal-actions-left {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.modal-body {
    padding-bottom: 0;
}
.btn-favorito,
.btn-assistido {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    height: 44px;
    padding: 0 14px;
    min-width: 130px;

    background: rgba(255,255,255,0.9);
    border: 1px solid rgba(60,60,67,0.18);
    border-radius: 14px;
    color: #1c1c1e;
    cursor: pointer;
    transition: 0.25s ease;
    font-weight: 600;
    font-size: 14px;
    letter-spacing: 0.2px;
    overflow: hidden;
    white-space: nowrap;
    box-shadow: 0 10px 22px rgba(0,0,0,0.10);
}

.btn-favorito:hover,
.btn-assistido:hover {
    transform: translateY(-1px);
    background: rgba(255,255,255,0.98);
}

.btn-favorito:active,
.btn-assistido:active {
    transform: scale(0.985);
}

.btn-favorito.active {
    background: rgba(255,159,10,0.16);
    border-color: rgba(255,159,10,0.40);
    color: #ff9f0a;
    box-shadow: none;
}

.btn-assistido.active {
    background: rgba(52,199,89,0.16);
    border-color: rgba(52,199,89,0.40);
    color: #248a3d;
    box-shadow: none;
}

.btn-favorito::after,
.btn-assistido::after {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at top left, rgba(255,255,255,0.2), transparent);
    opacity: 0;
    transition: 0.3s;
}

.btn-favorito:hover::after,
.btn-assistido:hover::after {
    opacity: 1;
}

.stars-container {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 12px;
    border-radius: 14px;
    background: rgba(255,255,255,0.72);
    border: 1px solid rgba(60,60,67,0.18);
}

.star {
    cursor: pointer;
    color: #c7c7cc;
    transition: 0.18s ease;
    font-size: 22px;
    line-height: 1;
}

.star:hover {
    transform: scale(1.18);
}

.star.active {
    color: #ffcc00;
    text-shadow: 0 0 10px rgba(255,204,0,0.35);
}

/* ----------------------------- */



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
    .modal-body {
        width: 92vw;
        height: 86vh;
    }

    .modal-actions {
        margin: 12px;
    }

    .btn-favorito,
    .btn-assistido {
        min-width: 0;
        flex: 1 1 140px;
    }
}
@media (max-width: 500px) {
    .movies-grid { grid-template-columns: repeat(1, 1fr); }
}

</style>

<?php
if (!isset($filmes)) {
    echo "<p>Nenhum filme encontrado.</p>";
    return;
}
?>

<?php if (isset($categoria)): ?>
    <h2 class='genre_title'> <?=$categoria?> </h2>
<?php endif; ?>

<?php if (isset($showFilters) && $showFilters): ?>
<div class="filter-bar">

    <div>
        <strong>NSFW</strong><br>
        <label class="switch">
            <input type="checkbox" id="adultSwitch" <?= ($adult ?? 'false') === 'true' ? 'checked' : '' ?>>
            <span class="slider"></span>
        </label>
    </div>
    <div>
        <strong>Ordenação</strong><br>
        <div class="segmented">
            <button id="descBtn" class="<?= ($order ?? 'desc') === 'desc' ? 'active' : '' ?>">Recentes</button>
            <button id="ascBtn"  class="<?= ($order ?? 'desc') === 'asc' ? 'active' : '' ?>">Antigos</button>
        </div>
    </div>

</div>
<?php endif; ?>


<div class="movies-grid">
<?php foreach ($filmes as $lan):

    $poster = !empty($lan['poster_path'])
        ? "https://image.tmdb.org/t/p/w500{$lan['poster_path']}"
        : null;

    $backdrop = !empty($lan['backdrop_path'])
        ? "https://image.tmdb.org/t/p/original{$lan['backdrop_path']}"
        : '';
?>

    <div class="movie-card"
        onclick='modalOpen(
            <?= json_encode($backdrop) ?>,
            <?= json_encode($lan["title"]) ?>,
            <?= json_encode($lan["overview"]) ?>,
            <?= $lan["id"] ?>,
            <?= json_encode($lan["release_date"]) ?>
        )'>

        <div class="movie-poster">
            <?php if ($poster): ?>
                <img src="<?= $poster ?>" alt="">
            <?php endif; ?>
        </div>

        <div class="movie-title">
            <?= htmlspecialchars($lan['title']) ?>
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

        <div class="modal-scroll">
            <div class="modal-content">
                <h2 id="modal-title"></h2>
                <span id="modal-data"></span>
                <p id="modal-overview"></p>
            </div>

            <div id="modal-streams"></div>
        </div>

        <div class="modal-actions">
            <div class="modal-actions-left">
                <button class="btn-favorito" type="button">
                    ⭐ Favoritar
                </button>

                <button class="btn-assistido" type="button">
                    👁️ Assistido
                </button>
            </div>

            <div class="stars-container">
                <span class="star" data-value="1">★</span>
                <span class="star" data-value="2">★</span>
                <span class="star" data-value="3">★</span>
                <span class="star" data-value="4">★</span>
                <span class="star" data-value="5">★</span>
            </div>
        </div>

    </div>
</div>


<?php if (isset($totalPages) && $totalPages > 1): 

    $maxLinks = 5;
    $start = max(1, $page - 2);
    $end = min($totalPages, $start + $maxLinks - 1);
?>

<div class="pagination">
    <?php for ($i = $start; $i <= $end; $i++): ?>
        <a href="?page=<?= $i ?>&adult=<?= $adult ?? 'false' ?>&order=<?= $order ?? 'desc' ?>">
            <div class="page-btn <?= $i == $page ? 'page-active' : '' ?>">
                <?= $i ?>
            </div>
        </a>
    <?php endfor; ?>
</div>

<?php endif; ?>


<script>

let currentMovieId = null;

async function modalOpen(backdrop, title, overview, movieId, data) {

    currentMovieId = movieId;

    document.getElementById("modal-img").src = backdrop;
    document.getElementById("modal-title").innerText = title;
    document.getElementById("modal-overview").innerText = overview;
    document.getElementById("modal-background").style.display = "flex";
    document.getElementById("modal-data").innerText = data;

    const container = document.getElementById("modal-streams");
    container.innerHTML = "<p>Carregando...</p>";


    try {
        const response = await fetch(`/providers?id=${movieId}`);
        const providers = await response.json();

        container.innerHTML = "";

        if (!providers || providers.length === 0) {
            container.innerHTML = "<p>Não disponível</p>";
        } else {
            providers.forEach(p => {
                container.innerHTML += `
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                        <img src="${p.logo}" width="40">
                        <span>${p.nome}</span>
                    </div>
                `;
            });
        }
    } catch (error) {
        container.innerHTML = "<p>Erro ao carregar.</p>";
    }


    document.querySelector(".btn-favorito")?.classList.remove("active");
    document.querySelector(".btn-assistido")?.classList.remove("active");
    document.querySelectorAll(".star").forEach(s => s.classList.remove("active"));

    try {
        const statusResponse = await fetch(`/user-movie-status?id=${movieId}`);
        const statusData = await statusResponse.json();

        if (statusData.success) {

            if (statusData.data.favorito == 1) {
                document.querySelector(".btn-favorito")?.classList.add("active");
            }

            if (statusData.data.assistido == 1) {
                document.querySelector(".btn-assistido")?.classList.add("active");
            }

            const nota = parseInt(statusData.data.nota);

            document.querySelectorAll(".star").forEach(star => {
                if (parseInt(star.dataset.value) <= nota) {
                    star.classList.add("active");
                }
            });

        }

    } catch (err) {
        console.log("Erro ao carregar status");
    }
}

function closeModal(event) {
    if (event && event.target !== event.currentTarget) return;
    document.getElementById("modal-background").style.display = "none";
}

function updateFilters(newAdult = null, newOrder = null) {
    const url = new URL(window.location.href);

    if (newAdult !== null)
        url.searchParams.set('adult', newAdult);

    if (newOrder !== null)
        url.searchParams.set('order', newOrder);

    url.searchParams.set('page', 1);
    window.location.href = url.toString();
}


document.addEventListener("DOMContentLoaded", function () {

    const adultSwitch = document.getElementById("adultSwitch");
    const descBtn = document.getElementById("descBtn");
    const ascBtn = document.getElementById("ascBtn");

    if (adultSwitch) {
        adultSwitch.addEventListener("change", function () {
            updateFilters(this.checked ? "true" : "false", null);
        });
    }

    if (descBtn) {
        descBtn.addEventListener("click", function () {
            updateFilters(null, "desc");
        });
    }

    if (ascBtn) {
        ascBtn.addEventListener("click", function () {
            updateFilters(null, "asc");
        });
    }

});

document.addEventListener("click", function(e) {

    if (!currentMovieId) return;

    if (e.target.classList.contains("btn-favorito")) {
        e.target.classList.toggle("active");
        enviarAcao(currentMovieId, "favorito");
    }

    if (e.target.classList.contains("btn-assistido")) {
        e.target.classList.toggle("active");
        enviarAcao(currentMovieId, "assistido");
    }

    if (e.target.classList.contains("star")) {
        const nota = parseInt(e.target.dataset.value);

        document.querySelectorAll(".star").forEach(star => {
            const value = parseInt(star.dataset.value);
            star.classList.toggle("active", value <= nota);
        });

        enviarAcao(currentMovieId, "nota", nota);
    }

});

function enviarAcao(movieId, action, value = null) {

    fetch("/user-movie-action", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `movie_id=${movieId}&action=${action}&value=${value ?? ""}`
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            console.log("Erro:", data.error);
        }
    })
    .catch(err => {
        console.log("Erro na requisição");
    });
}

</script>