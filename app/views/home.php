<?php 
require_once __DIR__ . '/../helpers/helper.php';
ob_start(); 
?>

<?php if (isset($_SESSION['flash'])): ?>

    <div id="custom_toast" class="custom_toast">
        <?= $_SESSION['flash']; ?>
    </div>

    <?php unset($_SESSION['flash']); ?>

<?php endif; ?>

<a href="/filmesPopulares">Filmes em alta</a>

<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>

