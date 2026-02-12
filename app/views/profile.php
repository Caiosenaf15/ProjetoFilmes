<?php
require_once "../app/helpers/helper.php";

if (!isset($_SESSION['user'])) {
    header("Location: /login");
    exit;
}
ob_start(); ?>

<h1> Olá, <?= userFormat($_SESSION['username'] ?? '' )?>!</h1>
<a href="/favorites">Editar favoritos</a>
<a href="#">Configurar conta</a>

<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>
