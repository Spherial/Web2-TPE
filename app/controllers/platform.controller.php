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


    public function platformForm($editing = null, $platform = null) {
        include_once './templates/header.phtml';
        require_once './templates/formPlataforma.phtml';

    }
    public function addPlatform() {
        if(isset($_POST['disponibilidad_ar'])) {
            $disponibilidad_ar = $_POST['disponibilidad_ar'];
        }
        else {
            $disponibilidad_ar = '0';
        }

        if ($this->validateData($_POST)) {
            $nombre = $_POST['nombre'];
            $enlace = $_POST['enlace'];
            $tipo_contenido = $_POST['tipo_contenido'];
            $precio = $_POST['precio'];
            $id_nueva = $this->model->POSTplatform($nombre, $enlace, $tipo_contenido, $disponibilidad_ar, $precio);
            if ($id_nueva) {
                header("Location:".BASE_URL."plataformas");
            }
            else {
                $this->$errorHelper->showError("no se pudo agregar la plataforma.");
            }
        }
    }
    public function removePlatform($platform_id) {
        try {
            $affectedRows = $this->model->DELETEplatform($platform_id);
            if($affectedRows>0) {
                header("Location:".BASE_URL."plataformas");
            }
            else {
                $this->errorHelper->showError("Plataforma no encontrada.");
            }
        }
        catch (PDOException $e){
            $this->errorHelper->showError("No es posible.");
        }
    }
    public function editPlatform($platform_id) {
        $platform = $this->model->getPlatformById($platform_id);
        if ($platform){
            $this->platformForm(true,$platform);
        }
        else{
            $this->errorHelper->showError("Plataforma no encontrada.");
        }
    }
    public function updatePlatform($platform_id) {
        if(isset($_POST['disponibilidad_ar'])) {
            $disponibilidad_ar = $_POST['disponibilidad_ar'];
        }
        else {
            $disponibilidad_ar = '0';
        }

        if ($this->validateData($_POST)) {
            $nombre = $_POST['nombre']; //mergeado
            $enlace = $_POST['enlace'];
            $tipo_contenido = $_POST['tipo_contenido'];
            $precio = $_POST['precio'];
            $affectedRows = $this->model->PUTplatform($nombre, $enlace, $tipo_contenido, $disponibilidad_ar, $precio, $platform_id);
            if ($affectedRows>0) {
                header("Location:".BASE_URL."plataformas");
            }
            else {
                $this->errorHelper->showError("no se pudo editar la plataforma.");
            }
        }
    }
}
?>