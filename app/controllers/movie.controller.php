<?php

require_once './app/views/movie.view.php';
require_once './app/models/movie.model.php';
require_once './helpers/error.helper.php';
require_once './helpers/auth.helper.php';
require_once './app/models/platform.model.php';

class MovieController{
    //Corregidas responsabilidades
    private $view;
    private $model;


    private $platformModel;
    private $errorHelper;
    private $authHelper;


    public function __construct(){
        $this->view = new MovieView();
        $this->model = new MovieModel();
        $this->errorHelper = new ErrorHelper();
        $this->authHelper = new AuthHelper();
        $this->platformModel = new platformModel(); //Model para traer todas las plataformas
    }



    //Muestra el home
    public function showHome(){
        $movies = $this->model->getLinksMovies();
        $this->view->renderHome($movies);
    }



    //Muestra el catalogo completo de peliculas y series
    public function showAllMovies(){
        $movies = $this->model->getAllMovies();
        $this->view->showMovieList($movies);
    }



    //Muestra el detalle de una pelicula con una ID determinada
    public function showMovieDetail($movie_id){
        if ($this->validateData([$movie_id])){
            
            
            $details = $this->model->getMovieDetail($movie_id);
            if ($details){
                $this->view->renderMovieDetail($details);
            }
            else{
                $this->errorHelper->showError("Pelicula no encontrada.");
            }
            
        }
    }



    //Llama al formulario de peliculas
    //Si se llama sin parametros, no precarga datos y se usa para agregar una nueva pelicula
    //Para editar una pelicula, se le llama con editing = true y con el objeto de la pelicula a editar
    public function movieForm($editing = null,$movie = null){
        $this->authHelper->checkLoggedIn();
        $platforms = $this->platformModel->getAllPlatforms();   //Para construir el select de plataformas
        $this->view->renderMovieForm($editing,$movie,$platforms);
        
    }


    //Recoge datos del Formulario y los inserta en la DB
    public function addMovie(){
        $this->authHelper->checkLoggedIn();
        if ($this->validateData($_POST)){
            $titulo = htmlspecialchars($_POST["titulo"], ENT_QUOTES, 'UTF-8');
            $sinopsis = htmlspecialchars($_POST["sinopsis"], ENT_QUOTES, 'UTF-8');
            $director = htmlspecialchars($_POST["director"], ENT_QUOTES, 'UTF-8');
            $fecha = htmlspecialchars($_POST["fecha"], ENT_QUOTES, 'UTF-8');
            $cast = htmlspecialchars($_POST["cast"], ENT_QUOTES, 'UTF-8');
            $plataforma = htmlspecialchars($_POST["plataforma"], ENT_QUOTES, 'UTF-8');
            $link_portada = htmlspecialchars($_POST["link_portada"], ENT_QUOTES, 'UTF-8');
            $lastId = $this->model->POSTmovie($titulo,$sinopsis,$director,$fecha,$cast,$plataforma,$link_portada);

            if ($lastId){
                header("Location:".BASE_URL."peliculas");
            }
            else{
                $this->errorHelper->showError("Ocurrio un error al realizarse la insercion");
            }
        }
        else{
            $this->errorHelper->showError("Deben rellenarse todos los campos del formulario");
            
           
            $this->movieForm(false);  //Formulario sin edicion
        }
    }



    //Elimina una pelicula de la BD a partir de una ID
    public function removeMovie($movie_id){
        $this->authHelper->checkLoggedIn();
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



    //Edita una pelicula segun un ID determinado
    public function editMovie($movie_id){
        $this->authHelper->checkLoggedIn();
        $movie = $this->model->getMovieById($movie_id); 
        if ($movie){
            $this->movieForm(true,$movie); //Se llama a la funcion indicandole que se va a editar
            
        }
        else{
            $this->errorHelper->showError("Pelicula no encontrada.");
        }
        
    }



    //Edita una pelicula segun una ID determinada (a traves del formulario anterior)
    public function updateMovie($id){
        $this->authHelper->checkLoggedIn();
        if (!$_POST){
            $this->errorHelper->showError("Falta informacion para actualizar datos.");
            die();
        }

        //En la sanitizacion, las comillas son transformadas, pudiendose ser visibles en el string final
        //El navegador no las toma en cuenta a la hora de procesar el HTML
        if ($this->validateData($_POST)){
            $titulo = htmlspecialchars($_POST["titulo"], ENT_QUOTES, 'UTF-8');
            $sinopsis = htmlspecialchars($_POST["sinopsis"], ENT_QUOTES, 'UTF-8');
            $director = htmlspecialchars($_POST["director"], ENT_QUOTES, 'UTF-8');
            $fecha = htmlspecialchars($_POST["fecha"], ENT_QUOTES, 'UTF-8');
            $cast = htmlspecialchars($_POST["cast"], ENT_QUOTES, 'UTF-8');
            $plataforma = htmlspecialchars($_POST["plataforma"], ENT_QUOTES, 'UTF-8');
            $link_portada = htmlspecialchars($_POST["link_portada"], ENT_QUOTES, 'UTF-8');
            $affectedRows = $this->model->PUTmovie($id,$titulo,$sinopsis,$director,$fecha,$cast,$plataforma,$link_portada);

            if ($affectedRows > 0){
                header("Location:".BASE_URL."peliculas");
            }
            else{
                $this->errorHelper->showError("Ocurrio un error al editar");
            }

        }
        else{
            $this->errorHelper->showError("Debe rellenar todos los campos");
            $movie = $this->model->getMovieById($id);
            $this->movieForm(true,$movie); //Formulario con edicion
        }
    }




    //Comprueba que todos los elementos de un array esten seteados y no esten vacios
    //Por lo general, sirve para comprobar los datos del arreglo $_POST
    private function validateData($data){
        foreach($data as $item){
            if (empty($item) || !isset($item)){
                return false;
            }
        }

        return true;
    }
}