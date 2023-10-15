<?php

class MovieView{

    //Renderiza el home
    public function renderHome(){
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
}