<?php

class MovieModel{
    private $db;
    //SELECT a.*, b.nombre FROM peliculas a INNER JOIN plataformas b ON a.plataforma_id = b.id_plataforma;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=streaming_peliculas;charset=utf8', 'root', '');
    }


    public function getAllMovies(){
        $query = $this->db->prepare("SELECT titulo FROM peliculas");
        $query->execute();
        $movies = $query->fetchAll(PDO::FETCH_OBJ);

        return $movies;
    }
}