<?php ob_start(); ?>

<h1>Search</h1>
<form action="">
    <input type="text" name="busca" id="busca">
    <button type="submit">Pesquisar</button>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>
