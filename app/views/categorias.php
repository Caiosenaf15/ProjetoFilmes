<?php 
    require_once __DIR__ . '/../helpers/helper.php';
    require_once __DIR__ . '/../controllers/TmdbService.php';

    $genId = $_GET['genero'] ?? '';
    ob_start(); 
?>

<?php if (isset($_SESSION['flash'])): ?>

    <div id="custom_toast" class="custom_toast">
        <?= $_SESSION['flash']; ?>
    </div>

    <?php unset($_SESSION['flash']); ?>

<?php endif; ?>

    <?php
        $tmdb = new TmdbService();
        $generos = $tmdb->listaGeneros();
    ?>
    <ul>
        <?php foreach ($generos as $gen): ?>
            <li>
                <a href="?genero=<?= $gen['id']; ?>"><?= $gen['nome']; ?></a> 
            </li>
        <?php endforeach; ?>
    </ul>
    <p><?= $genId; ?></p>

<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>

