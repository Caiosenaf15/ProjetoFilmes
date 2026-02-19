<?php


switch($url) {
    
    case '':
        require_once "../app/views/home.php";
        break;
    
    case 'favorites':
        require_once "../app/views/favorites.php";
        break;

    case 'login':
        if (isset($_SESSION['user'])) {
            $_SESSION['flash'] = "Você já está logado!";
            header("Location: /");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "../app/controllers/AuthController.php";
            $auth = new AuthController();
            $auth->login();
        } else {
            require_once "../app/views/login.php";
        }
        break;

    case 'logout':
        session_destroy();
        header("Location: /");
        exit;
        break;

    case 'listaFilmes':
        require_once "../app/views/paginaListaFilmes.php";
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "../app/controllers/AuthController.php";
            $auth = new AuthController();
            $auth->register();
        } else {
            require_once "../app/views/register.php";
        }
        break;
    
    case 'forgot':
        require_once "../app/views/forgot.php";
        break;
    
    case 'search':
        require_once "../app/views/search.php";
        break;
        
    case 'movie':
        require_once "../app/views/moviesId.php";
        break;

    case 'profile':
        require_once "../app/views/profile.php";
        break;
    
    default:
        echo "Página não encontrada";
}

?>