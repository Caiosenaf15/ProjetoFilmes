<?php 
    $id = $_GET["id"];
    if(! is_numeric($id)){
        $id = 'Id não numerico';
    };
    ob_start(); 
?>

<h1>Filme</h1>
<?php 
echo 'O id é: '.$id;
?>

<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>
