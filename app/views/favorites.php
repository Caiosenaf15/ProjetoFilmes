<?php
if (!isset($_SESSION['user'])) {
    header("Location: /login");
    exit;
} 
ob_start(); ?>

<h1>Favoritos ⭐</h1>

<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>
