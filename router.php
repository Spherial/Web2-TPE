<?php
//REQUIRES

require_once './app/controllers/movie.controller.php';
require_once './helpers/error.helper.php';


$MovieController = new MovieController();
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
    default: 
        $ErrorHelper->showError("404 - Recurso no encontrado"); //Placeholder de error
        break;
}


?>