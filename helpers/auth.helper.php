<?php
    class AuthHelper{
        public function checkLoggedIn(){

            //Comprueba que la sesion no exista antes de volverla a abrir
            //(Para evitar que php arroje un notice cuando se llama 2 veces)

            if (session_status() == PHP_SESSION_NONE) {  //Si no hay sesion
                session_start(); //La llama
            }


            //Si el usuario no esta logueado, se lo redirecciona al formulario de login
            if (!isset($_SESSION["id"])){
                header("Location:".BASE_URL."auth");
            }
        }
    }
