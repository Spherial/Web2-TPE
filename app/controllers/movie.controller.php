<?php

require_once './app/views/movie.view.php';
require_once './app/models/movie.model.php';
require_once './helpers/error.helper.php';

class MovieController{

    private $view;
    private $model;

    private $errorHelper;


    public function __construct(){
        $this->view = new MovieView();
        $this->model = new MovieModel();
        $this->errorHelper = new ErrorHelper();
    }


    public function showHome(){
        $this->view->renderHome();
    }

    public function showAllMovies(){
        $movies = $this->model->getAllMovies();
        $this->view->showMovieList($movies);
    }

    public function showMovieDetail($movie_id){
        $titulo = "Detalle";
        $subtitulo = "Detalles de la pelicula";
        include_once './templates/header.phtml';
        $details = $this->model->getMovieDetail($movie_id);
        require_once './templates/movieDetail.phtml';
        
    }

    public function formAddMovie(){
        $titulo = "Agregar Pelicula";
        $subtitulo = "Ingrese los datos";
        $platforms = $this->model->getAllPlatforms();
        include_once './templates/header.phtml';
        include_once './templates/formAddPelicula.phtml';
        
    }

    public function addMovie(){
        if ($this->validateData($_POST)){
            $titulo = $_POST["titulo"];
            $sinopsis = $_POST["sinopsis"];
            $director = $_POST["director"];
            $fecha = $_POST["fecha"];
            $cast = $_POST["cast"];
            $plataforma = $_POST["plataforma"];
            $lastId = $this->model->POSTmovie($titulo,$sinopsis,$director,$fecha,$cast,$plataforma);

            if ($lastId){
                header("Location:".BASE_URL."peliculas");
            }
            else{
                $this->errorHelper->showError("Ocurrio un error al realizarse la insercion");
            }
        }
        else{
            $this->errorHelper->showError("Deben rellenarse todos los campos del formulario");
            include_once './templates/formAddPelicula.phtml';
        }
    }


    private function validateData($data){
        foreach($data as $item){
            if (empty($item) || !isset($item)){
                return false;
            }
        }

        return true;
    }
}