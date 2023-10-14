<?php

    class AuthView{



        //Renderiza el formulario de login
        public function renderLoginForm(){
            require_once './templates/header.phtml';
            require_once './templates/formLogin.phtml';
            
        }
    }