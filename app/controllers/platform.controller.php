<?php

require_once './app/views/platform.view.php';
require_once './app/models/platform.model.php';
require_once './helpers/error.helper.php';

class platformController{
    private $view;
    private $model;

    private $errorHelper;

    public function __construct(){
        $this->view = new PlatformView();
        $this->model = new PlatformModel();
        $this->errorHelper = new ErrorHelper();
    }

    public function showHome(){
        $this->view->renderHome();
    }

    public function showAllPlatforms(){
        $platforms = $this->model->getAllPlatforms();
        $this->view->showPlatformList($platforms);
    }

    public function showAllMoviesPlatform($platform_id) {
        if ($this->validateData([$platform_id])) {
            $titulo = "Plataforma";
            $subtitulo = "categoria";
            include_once './templates/header.phtml';
    
            // info de la plataforma
            $details = $this->model->getPlatformDetails($platform_id);
    
            if ($details) {
                // todas las películas de la pagina que estan en la plataforma
                $movies = $this->model->getAllMoviesByPlatform($platform_id);

                require_once './templates/platformDetail.phtml';
            } else {
                $this->errorHelper->showError("Plataforma no encontrada.");
            }
        }
    }

    private function validateData($data){
        foreach($data as $item){
            if (empty($item) || !isset($item)){
                return false;
            }
        }

        return true;
    }


    public function platformForm() {

    }
    public function addPlatform() {

    }
    public function platformAvailableToRemove() {
    
    }
    public function removePlatform() {

    }
    public function editPlatform() {
    
    }
    public function updatePlatform() {

    }
}

?>