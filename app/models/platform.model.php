<?php

require_once './app/models/model.php';

    class platformModel extends Model{
     


        //Obtiene una plataforma segun una ID
        public function getPlatformById($platform_id) {
            $query = $this->db->prepare("SELECT * FROM plataformas WHERE id_plataforma = ?");
            $query->execute([$platform_id]);
            $platform = $query->fetch(PDO::FETCH_OBJ);
    
            return $platform;
        }


        



        //Obtiene los detalles de una plataforma
        public function getPlatformDetails($platform_id) {
            $query = $this->db->prepare("SELECT * FROM plataformas WHERE id_plataforma = ?");
            $query->execute([$platform_id]);
            $details = $query->fetch(PDO::FETCH_OBJ);
            return $details;
        }



        //Obtiene todas las peliculas pertenecientes a una plataforma dada
        public function getAllMoviesByPlatform($platform_id) {
            $query = $this->db->prepare("SELECT * FROM peliculas WHERE plataforma_id = ?");
            $query->execute([$platform_id]);
            $movies = $query->fetchAll(PDO::FETCH_OBJ);
            return $movies;
        }



        //Obtiene todas las plataformas
        public function getAllPlatforms(){
            $query = $this->db->prepare("SELECT id_plataforma, nombre FROM plataformas");
            $query->execute();
            $platforms = $query->fetchAll(PDO::FETCH_OBJ);
    
            return $platforms;
        }

        public function POSTplatform($nombre, $enlace, $tipo_contenido, $disponibilidad_ar, $precio,$link_logo){
            $query = $this->db->prepare("INSERT INTO `plataformas`(`nombre`, `enlace`, `tipo_contenido`, `disponibilidad_ar`, `precio`, `link_logo`) VALUES (?, ?, ?, ?, ?, ?)");
            $query->execute([$nombre, $enlace, $tipo_contenido, $disponibilidad_ar, $precio,$link_logo]);
            return $this->db->lastInsertId();
        }

        public function PUTplatform($nombre, $enlace, $tipo_contenido, $disponibilidad_ar, $precio, $platform_id,$link_logo){
            $query = $this->db->prepare("UPDATE plataformas SET `nombre`= ?,`enlace`= ?,`tipo_contenido`= ? ,`disponibilidad_ar`= ? ,`precio`= ?, `link_logo`= ? WHERE id_plataforma = ?");
            $query->execute([$nombre, $enlace, $tipo_contenido, $disponibilidad_ar, $precio,$link_logo ,$platform_id]);
            return $query->rowCount();
        }

        public function DELETEplatform($platform_id){
            $query = $this->db->prepare("DELETE FROM `plataformas` WHERE id_plataforma = ? ");
            $query->execute([$platform_id]);
            return $query->rowCount();
        }
    }
?>