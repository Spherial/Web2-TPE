<?php
require_once './app/models/model.php';
    class AuthModel extends Model{
       


        //Obtiene un usuario segun su nombre
        public function getUserByName($name){
            $query = $this->db->prepare("SELECT * FROM usuarios WHERE username = ?");
            $query->execute([$name]);
            $user = $query->fetch(PDO::FETCH_OBJ);

            return $user;

            
        }
    }