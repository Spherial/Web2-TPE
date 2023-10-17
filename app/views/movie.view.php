<?php

class MovieView{

    //Renderiza el home
    public function renderHome($movies){
        $titulo = "StreamingNet";
        $subtitulo = "Busque su serie o pelicula";
        include_once './templates/header.phtml';
        include_once './templates/home.phtml';
    }



    //Muestra la lista de todas las peliculas
    public function showMovieList($movies){
        $titulo = "Peliculas";
        $subtitulo = "Un listado de todas las peliculas";
        include_once './templates/header.phtml';
        include_once './templates/movieList.phtml';
    }

    public function renderMovieForm($editing = null,$movie = null, $platforms = null){
        include_once './templates/header.phtml';
        include_once './templates/formPelicula.phtml';
    }

    public function renderMovieDetail($details){
        $titulo = "Detalle";
        $subtitulo = "Detalles de la pelicula";

        include_once './templates/header.phtml';
        require_once './templates/movieDetail.phtml';
    }



}