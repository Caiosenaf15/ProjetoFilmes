<?php 
require_once __DIR__ . '/../helpers/helper.php';
require_once __DIR__ . '/../controllers/favController.php';
require_once __DIR__ . '/../controllers/TmdbService.php';

$filmesFavoritados = [];

if( isset($_SESSION['username']) ){

    echo "1";
    
    $con = new favController();
    echo "2";
    
    $dataFavoritos = $con->favoritos();
    echo "3";
    
    var_dump($dataFavoritos);
    die();
    //$con = new favController();
    //$dataFavoritos = $con->favoritos();
    $showFilters = false;
    $tmdb = new TmdbService();
    
    foreach($dataFavoritos as $fav){
        if($fav['favorito'] == 1){
            $filmesFavoritados[] = $tmdb->buscarFilme($fav['movie_id']);
        }
    }
    $filmes = $filmesFavoritados;
}
// aa
ob_start();
require __DIR__ . '/../partials/movie_list.php';
?>



<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>
