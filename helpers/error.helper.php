<?php 

class ErrorHelper{
 


    public function showError($error){
        include_once './templates/header.phtml';
        require_once './templates/error.phtml';
    }
}