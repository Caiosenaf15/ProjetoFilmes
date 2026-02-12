<?php ob_start(); ?>

<h1>Home</h1>
<p>Bem-vindo ao BD Filmes</p>

<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>
