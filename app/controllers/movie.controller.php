<?php
//Merge
require_once './app/views/movie.view.php';
require_once './app/models/movie.model.php';
require_once './app/helpers/error.helper.php';

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
        if ($this->validateData([$movie_id])){
            $titulo = "Detalle";
            $subtitulo = "Detalles de la pelicula";
            include_once './templates/header.phtml';
            $details = $this->model->getMovieDetail($movie_id);
            if ($details){
                require_once './templates/movieDetail.phtml';
            }
            else{
                $this->errorHelper->showError("Pelicula no encontrada.");
            }
            
        }
     
        
    }

    public function movieForm($editing = null,$movie = null){
       
        $platforms = $this->model->getAllPlatforms();
        include_once './templates/header.phtml';
        include_once './templates/formPelicula.phtml';
        
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
            $platforms = $this->model->getAllPlatforms();
            include_once './templates/formPelicula.phtml';
        }
    }

    public function removeMovie($movie_id){
        if ($this->validateData([$movie_id])){
            $affectedRows = $this->model->DELETEmovie($movie_id);

            if ($affectedRows > 0 ){
                header("Location:".BASE_URL."peliculas");
            }
            else{
                $this->errorHelper->showError("Ocurrio un error al intentar eliminar");
            }
        }
    }

    public function editMovie($movie_id){
        $movie = $this->model->getMovieById($movie_id);
        if ($movie){
            $this->movieForm(true,$movie);
            
        }
        else{
            $this->errorHelper->showError("Pelicula no encontrada.");
        }
        
    }

    public function updateMovie($id){
        if (!$_POST){
            $this->errorHelper->showError("Falta informacion para actualizar datos.");
            die();
        }


        if ($this->validateData($_POST)){
            $titulo = $_POST["titulo"];
            $sinopsis = $_POST["sinopsis"];
            $director = $_POST["director"];
            $fecha = $_POST["fecha"];
            $cast = $_POST["cast"];
            $plataforma = $_POST["plataforma"];

            $affectedRows = $this->model->PUTmovie($id,$titulo,$sinopsis,$director,$fecha,$cast,$plataforma);

            if ($affectedRows > 0){
                header("Location:".BASE_URL."peliculas");
            }
            else{
                $this->errorHelper->showError("Ocurrio un error al editar");
            }

        }
        else{
            $this->errorHelper->showError("Debe rellenar todos los campos");
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