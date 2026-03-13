<?php 
require_once __DIR__ . '/../controllers/TmdbService.php';

$tmdb = new TmdbService();
$populares = $tmdb->filmesPopulares();
$filmesPopulares = $populares['results'] ?? [];

$totalPorSlide = 5;
$resto = count($filmesPopulares) % $totalPorSlide;

if ($resto !== 0) {
    $faltando = $totalPorSlide - $resto;
    for ($i = 0; $i < $faltando; $i++) {
        $filmesPopulares[] = $filmesPopulares[$i];
    }
}

$chunks = array_chunk($filmesPopulares, $totalPorSlide);

$showFilters = false;
ob_start();
?>

<style>
   #banner{
        margin-top:40px;
        padding:0 60px;
    }

    #banner span{
        font-size:22px;
        font-weight:600;
        margin-bottom:15px;
        display:block;
    }

    .card{
        border:none;
        background:none;
        width:170px;
    }

    .card img{
        width:170px;
        height:255px;
        object-fit:cover;
        border-radius:8px;
    }

    .card:hover img{
        transform:scale(1.08);
        z-index:10;
        transition: 0.3s;
    }

    .card-body{
        padding:8px 0 0 0;
    }

    .card-title{
        font-size:14px;
        text-align:center;
        margin:0;
    }

    .carousel-inner{
        padding:10px 70px;
    }

    .carousel-control-prev,
    .carousel-control-next{
        width:50px;
        height:50px;
        top:50%;
        transform:translateY(-50%);
        z-index:1000;
    }

    .carousel-control-prev{
        left:0;
    }

    .carousel-control-next{
        right:0;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon{
        background-color:rgba(0,0,0,0.6);
        border-radius:50%;
        padding:20px;
        background-size:60%;
        filter:invert(1);
    }
</style>

<?php if (isset($_SESSION['flash'])): ?>

    <div id="custom_toast" class="custom_toast">
        <?= $_SESSION['flash']; ?>
    </div>

    <?php unset($_SESSION['flash']); ?>

<?php endif; ?>

<main>
    <article id='main_banner'>
        <img src="" alt="">
    </article>

    <article id='banners'>

        <section id='banner'>
            <span>Populares</span>

            <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">

            <?php foreach($chunks as $index => $grupo): ?>

            <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
            <div class="d-flex justify-content-center gap-4">
                
            <?php foreach($grupo as $filme): 
                $poster = !empty($filme['poster_path'])
                ? "https://image.tmdb.org/t/p/w500{$filme['poster_path']}"
                : null;
                ?>

            <div class="card" style="width:200px;">
                <img src="<?= $poster ?>" class="card-img-top">
                <div class="card-body">
                    <p class="card-title"><?= $filme['title'] ?></p>
                </div>
            </div>

            <?php endforeach; ?>

            </div>
            </div>

            <?php endforeach; ?>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            </button>

            </div>

        </section>

        <section id='banner'>
            <span>Lancamentos</span>
        </section>

        <section id='banner'>
            <span>Categorias</span>
        </section>

        <?php if(isset($_SESSION['username'])): ?>
            <section id='banner'>
                <span>Seus Favoritos</span>
            </section>
        <?php endif; ?>

    </article>
</main>

<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>