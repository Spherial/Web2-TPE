<?php

require_once './app/views/movie.view.php';

class MovieController{

    private $view;
    //private $model;


    public function __construct(){
        $this->view = new MovieView();
    }


    public function showHome(){
        $this->view->renderHome();
    }
}