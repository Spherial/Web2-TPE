<?php

class MovieModel{
    private $db;
    //SELECT a.*, b.nombre FROM peliculas a INNER JOIN plataformas b ON a.plataforma_id = b.id_plataforma;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=streaming_peliculas;charset=utf8', 'root', '');
    }


    public function getAllMovies(){
        $query = $this->db->prepare("SELECT id_pelicula,titulo FROM peliculas");
        $query->execute();
        $movies = $query->fetchAll(PDO::FETCH_OBJ);

        return $movies;
    }


    //Obtiene la informacion de determinada pelicula, incluyendo su plataforma
    public function getMovieDetail($movie_id){
        $query = $this->db->prepare("SELECT a.*, b.nombre FROM peliculas a INNER JOIN plataformas b ON a.plataforma_id = b.id_plataforma WHERE id_pelicula = ?");
        $query->execute([$movie_id]);
        $details = $query->fetch(PDO::FETCH_OBJ);

        return $details;
    }
}