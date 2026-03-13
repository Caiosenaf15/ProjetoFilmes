<?php 
    require_once __DIR__ . '/../helpers/helper.php';
    require_once __DIR__ . '/../controllers/TmdbService.php';

    ob_start(); 
?>

<?php if (isset($_SESSION['flash'])): ?>

    <div id="custom_toast" class="custom_toast">
        <?= $_SESSION['flash']; ?>
    </div>

    <?php unset($_SESSION['flash']); ?>

<?php endif; ?>

<style>
    .generos-container{
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        margin: 40px 0;
    }

    .genero-btn{
        padding: 30px 54px;
        border-radius: 20px;
        border: none;
        background: #dbdbdb;
        color: black;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .genero-btn:hover{
        background: #e5091486;
        transform: scale(1.05);
        box-shadow: 2px 5px rgba(0, 0, 0, 0.8);
    }
</style>

    <?php
        $tmdb = new TmdbService();
        $generos = $tmdb->listaGeneros();
    ?>
    <div class="generos-container">
        <?php foreach ($generos as $gen): ?>
            <form action="/categoria?genero=<?= urlencode($gen['nome']) ?>" method="POST">
                <input type="hidden" name="id_genero" value="<?= $gen['id'] ?>">
                <button class="genero-btn" type="submit">
                    <?= $gen['nome'] ?>
                </button>
            </form>
        <?php endforeach; ?>
    </div>

<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>

