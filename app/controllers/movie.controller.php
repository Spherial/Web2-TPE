<?php

require_once './app/views/movie.view.php';
require_once './app/models/movie.model.php';

class MovieController{

    private $view;
    private $model;


    public function __construct(){
        $this->view = new MovieView();
        $this->model = new MovieModel();
    }


    public function showHome(){
        $this->view->renderHome();
    }

    public function showAllMovies(){
        $movies = $this->model->getAllMovies();
        $this->view->showMovieList($movies);
    }
}