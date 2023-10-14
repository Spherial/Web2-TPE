<?php

    class AuthModel{
        private $db;



        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=streaming_peliculas;charset=utf8', 'root', '');
        }




        //Obtiene un usuario segun su nombre
        public function getUserByName($name){
            $query = $this->db->prepare("SELECT * FROM usuarios WHERE username = ?");
            $query->execute([$name]);
            $user = $query->fetch(PDO::FETCH_OBJ);

            return $user;

            
        }
    }