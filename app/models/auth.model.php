<?php

    class AuthModel{
        private $db;



        public function __construct(){
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
        }




        //Obtiene un usuario segun su nombre
        public function getUserByName($name){
            $query = $this->db->prepare("SELECT * FROM usuarios WHERE username = ?");
            $query->execute([$name]);
            $user = $query->fetch(PDO::FETCH_OBJ);

            return $user;

            
        }
    }