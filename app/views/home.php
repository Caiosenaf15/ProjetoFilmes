<?php require_once '../app/helpers/helper.php';
ob_start(); 
?>

<?php if (isset($_SESSION['flash'])): ?>

    <div id="custom_toast" class="custom_toast">
        <?= $_SESSION['flash']; ?>
    </div>

    <?php unset($_SESSION['flash']); ?>

<?php endif; ?>



<?php if (isset($_SESSION['username'])): ?>
    <span>Bem-vindo, <?= userFormat($_SESSION['username']); ?> 👋</span>
    <a href="/logout">
        <button>Sair</button>
    </a>

    <a href="/listaFilmes">Lista de Generos</a>

<?php else: ?>
    <a href="/login">
            <button>Login</button>
        </a>
<?php endif; ?>

<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>

