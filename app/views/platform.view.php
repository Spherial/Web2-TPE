<?php
    class platformView{
        public function renderHome(){
            $titulo = "StreamingNet";
            $subtitulo = "Busque su plataforma preferida";
            include_once './templates/header.phtml';
            include_once './templates/home.phtml';
        }
    
        public function showPlatformList($platforms){
            $titulo = "Plataformas";
            $subtitulo = "Un listado de todas las categorias";
            include_once './templates/header.phtml';
            include_once './templates/platformList.phtml';
        }

        public function showPlatformInfo($platform){
            include_once './templates/platformInfo.phtml';
            include_once './templates/MoviesPlatformList.phtml';
        }
    }
?>