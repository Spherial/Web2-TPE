<?php

    class platformModel{
        private $db;
        //SELECT a.*, b.nombre FROM plataforma a INNER JOIN pelicula b ON a.plataforma_id = b.id_plataforma;
    
        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=streaming_peliculas;charset=utf8', 'root', '');
        }

        public function getPlatformDetails($platform_id) {
            $query = $this->db->prepare("SELECT * FROM plataformas WHERE id_plataforma = ?");
            $query->execute([$platform_id]);
            $details = $query->fetch(PDO::FETCH_OBJ);
            return $details;
        }

        public function getAllMoviesByPlatform($platform_id) {
            $query = $this->db->prepare("SELECT * FROM peliculas WHERE plataforma_id = ?");
            $query->execute([$platform_id]);
            $movies = $query->fetchAll(PDO::FETCH_OBJ);
            return $movies;
        }

        public function getAllPlatforms(){
            $query = $this->db->prepare("SELECT id_plataforma, nombre FROM plataformas");
            $query->execute();
            $platforms = $query->fetchAll(PDO::FETCH_OBJ);
    
            return $platforms;
        }
    }
?>