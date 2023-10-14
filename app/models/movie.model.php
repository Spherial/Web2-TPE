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

    public function getMovieById($id){
        $query = $this->db->prepare("SELECT * FROM peliculas WHERE id_pelicula = ?");
        $query->execute([$id]);
        $movie = $query->fetch(PDO::FETCH_OBJ);

        return $movie;
    }


    //Obtiene la informacion de determinada pelicula, incluyendo su plataforma
    public function getMovieDetail($movie_id){
        $query = $this->db->prepare("SELECT a.*, b.nombre FROM peliculas a INNER JOIN plataformas b ON a.plataforma_id = b.id_plataforma WHERE id_pelicula = ?");
        $query->execute([$movie_id]);
        $details = $query->fetch(PDO::FETCH_OBJ);
        return $details;
    }

    public function getAllPlatforms(){
        $query = $this->db->prepare("SELECT id_plataforma,nombre FROM plataformas");
        $query->execute();
        $platforms = $query->fetchAll(PDO::FETCH_OBJ);
        return $platforms;
    }

    public function POSTmovie($titulo,$sinopsis,$director,$fecha,$cast,$plataforma){
        $query = $this->db->prepare("INSERT INTO `peliculas`(`titulo`, `sinopsis`, `director`, `año_lanzamiento`, `cast`, `plataforma_id`) VALUES (?,?,?,?,?,?)");
        $query->execute([$titulo,$sinopsis,$director,$fecha,$cast,$plataforma]);
        return $this->db->lastInsertId();
    }

    public function PUTmovie($id,$titulo,$sinopsis,$director,$fecha,$cast,$plataforma){
        $query = $this->db->prepare("UPDATE peliculas SET `titulo`= ?,`sinopsis`= ?,`director`= ? ,`año_lanzamiento`= ? ,`cast`= ? ,`plataforma_id`= ? WHERE id_pelicula = ?");
        $query->execute([$titulo,$sinopsis,$director,$fecha,$cast,$plataforma,$id]);
        return $query->rowCount();
    }

    public function DELETEmovie($id){
        $query = $this->db->prepare("DELETE FROM peliculas WHERE id_pelicula = ? ");
        $query->execute([$id]);
        return $query->rowCount();
    }
}