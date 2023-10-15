<?php
//REQUIRES
require_once './config.php';
require_once './app/controllers/movie.controller.php';
require_once './app/controllers/platform.controller.php';
require_once './app/controllers/auth.controller.php';
require_once './helpers/error.helper.php';


$MovieController = new MovieController();
$platformController = new platformController();
$authController = new AuthController();
$ErrorHelper = new ErrorHelper();


define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');


// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home'; // acción por defecto si no envían
}




$params = explode('/', $action);

// Determina que camino seguir según la acción
switch ($params[0]) {
    case 'auth':
        $authController->formLogin();
        break;
    case 'logout':
        $authController->session_destroy();
        break;
    case 'login':
        $authController->login();
        break;
    case 'home':
        $MovieController->showHome();
        break;
    case 'peliculas':
        if (isset($params[1]) && !empty($params[1])){
            $MovieController->showMovieDetail($params[1]);
        }
        else{
            $MovieController->showAllMovies();
        }
        break;
    case 'agregarPelicula':
        $MovieController->movieForm();
        break;
    case 'addMovie':
        $MovieController->addMovie();
        break;
    case 'eliminarPelicula':
        if (isset($params[1]) && !empty($params[1])){
            $MovieController->removeMovie($params[1]);
        }
        else{
            $ErrorHelper->showError("Se debe proveer una pelicula para borrar");
        }
        break;

    case 'editarPelicula':
        if (isset($params[1]) && !empty($params[1])){
            $MovieController->editMovie($params[1]);
        }
        else{
            $ErrorHelper->showError("Se debe proveer una pelicula para editar");
        }
        break;
    case 'updateMovie':
        if (isset($params[1]) && !empty($params[1])){
            $MovieController->updateMovie($params[1]);
        }
        else{
            $ErrorHelper->showError("Se debe proveer una pelicula para editar");
        }
        break;


        case 'plataformas':
            if (isset($params[1]) && !empty($params[1])){
                $ErrorHelper->showError("No hay plataformas cargadas");
            }
            else {
                $platformController -> showAllPlatforms(); break;
            }
            break;
        case 'plataforma':
            $platformController -> showAllMoviesPlatform($params[1]);
            break;
        case 'agregarPlataforma':
            $platformController -> platformForm();
            break;
        case 'addPlatform':
            $platformController -> addPlatform();
            break;
        case 'eliminarPlataforma':
            if (isset($params[1]) && !empty($params[1])) {
                $platformController->removePlatform($params[1]);
            }
            break;
        case 'editarPlataforma':
            if (isset($params[1]) && !empty($params[1])){
                $platformController->editPlatform($params[1]);//NO HECHO
            }
            else{
                $ErrorHelper->showError("Se debe proveer una Plataforma para editar");
            }
            break;
        case 'updatePlataforma':
            if (isset($params[1]) && !empty($params[1])){
                $platformController->updatePlatform($params[1]);//NO HECHO
            }
            else{
                $ErrorHelper->showError("Se debe proveer una plataforma para editar");
            }
            break;
    default:
        $ErrorHelper->showError("404 - Recurso no encontrado");
        break;
}
?>