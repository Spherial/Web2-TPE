<?php

    class platformModel{
        private $db;
        //SELECT a.*, b.nombre FROM plataforma a INNER JOIN pelicula b ON a.plataforma_id = b.id_plataforma;
    
        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=streaming_peliculas;charset=utf8', 'root', '');
        }

        public function getPlatformById($platform_id) {
            $query = $this->db->prepare("SELECT * FROM plataformas WHERE id_plataforma = ?");
            $query->execute([$platform_id]);
            $platform = $query->fetch(PDO::FETCH_OBJ);
    
            return $platform;
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

        public function POSTplatform($nombre, $enlace, $tipo_contenido, $disponibilidad_ar, $precio){
            $query = $this->db->prepare("INSERT INTO `plataformas`(`nombre`, `enlace`, `tipo_contenido`, `disponibilidad_ar`, `precio`) VALUES (?, ?, ?, ?, ?)");
            $query->execute([$nombre, $enlace, $tipo_contenido, $disponibilidad_ar, $precio]);
            return $this->db->lastInsertId();
        }

        public function PUTplatform($nombre, $enlace, $tipo_contenido, $disponibilidad_ar, $precio, $platform_id){
            $query = $this->db->prepare("UPDATE plataformas SET `nombre`= ?,`enlace`= ?,`tipo_contenido`= ? ,`disponibilidad_ar`= ? ,`precio`= ? WHERE id_plataforma = ?");
            $query->execute([$nombre, $enlace, $tipo_contenido, $disponibilidad_ar, $precio, $platform_id]);
            return $query->rowCount();
        }

        public function DELETEplatform($platform_id){
            $query = $this->db->prepare("DELETE FROM `plataformas` WHERE id_plataforma = ? ");
            $query->execute([$platform_id]);
            return $query->rowCount();
        }
    }
?>