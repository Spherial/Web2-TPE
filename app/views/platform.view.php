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


        public function renderAllMoviesPlatform($movies,$details){
            $titulo = "Plataforma";
            $subtitulo = "Categoria";
            include_once './templates/header.phtml';
            require_once './templates/platformDetail.phtml';
        }


        public function renderPlatformForm($editing = null, $platform = null){
            include_once './templates/header.phtml';
            require_once './templates/formPlataforma.phtml';
        }
    }
?>