<?php

switch($url) {
    
    case '':
        require_once __DIR__ . '/../app/views/home.php';
        break;
    
    case 'favorites':
        require_once __DIR__ . '/../app/views/favorites.php';
        break;

    case 'login':
        if (isset($_SESSION['user'])) {
            $_SESSION['flash'] = "Você já está logado!";
            header("Location: /");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/controllers/AuthController.php';
            $auth = new AuthController();
            $auth->login();
        } else {
            require_once __DIR__ . '/../app/views/login.php';
        }
        break;

    case 'logout':
        session_destroy();
        header("Location: /");
        exit;

    case 'categorias':
        require_once __DIR__ . '/../app/views/categorias.php';
        break;

    case 'lancamentos':
        require_once __DIR__ . '/../app/views/lancamentos.php';
        break;

    case 'filmesPopulares':
        require_once __DIR__ . '/../app/views/filmesPopulares.php';
        break;

    case 'buscar':
        require_once __DIR__ . '/../app/views/pesquisa.php';
        break;
    
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../app/controllers/AuthController.php';
            $auth = new AuthController();
            $auth->register();
        } else {
            require_once __DIR__ . '/../app/views/register.php';
        }
        break;
    
    case 'forgot':
        require_once __DIR__ . '/../app/views/forgot.php';
        break;
    
    case 'search':
        require_once __DIR__ . '/../app/views/search.php';
        break;
        
    case 'movie':
        require_once __DIR__ . '/../app/views/moviesId.php';
        break;

    case 'profile':
        require_once __DIR__ . '/../app/views/profile.php';
        break;

    case 'api/movie_action':
    case 'api/movie_action.php':
        require_once __DIR__ . '/../app/controllers/UserMovieController.php';
        exit;
    
    default:
        echo "Página não encontrada";
}
