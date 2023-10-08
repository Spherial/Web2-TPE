<?php
//REQUIRES

require_once './app/controllers/movie.controller.php';


$MovieController = new MovieController();


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
    default: 
        echo('404 Page not found'); //Placeholder de error
        break;
}


?>