<?php
    class ErrorHelper{



        //Muestra un cuadro de error, recibe un String
        public function showError($error){
            include_once './templates/header.phtml';
            require_once './templates/error.phtml';
        }
    }
?>