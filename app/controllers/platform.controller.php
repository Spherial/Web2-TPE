<?php

require_once './app/views/platform.view.php';
require_once './app/models/platform.model.php';
require_once './helpers/error.helper.php';
require_once './helpers/auth.helper.php';

class platformController{
    private $view;
    private $model;

    private $errorHelper;
    private $authHelper;

    public function __construct(){
        $this->view = new PlatformView();
        $this->model = new PlatformModel();
        $this->errorHelper = new ErrorHelper();
        $this->authHelper = new AuthHelper();
    }

    public function showHome(){
        $this->view->renderHome();
    }



    //Muestra un listado de todas las plataformas de Streaming
    public function showAllPlatforms(){
        $platforms = $this->model->getAllPlatforms();
        $this->view->showPlatformList($platforms);
    }


    //Muestra todas las peliculas de una plataforma dada
    public function showAllMoviesPlatform($platform_id) {
        if ($this->validateData([$platform_id])) {
           
    
            // info de la plataforma
            $details = $this->model->getPlatformDetails($platform_id);
    
            if ($details) {
                // todas las películas de la pagina que estan en la plataforma
                $movies = $this->model->getAllMoviesByPlatform($platform_id);

                $this->view->renderAllMoviesPlatform($movies,$details);
                
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





    //Formulario de plataformas (Sin parametros = agregar, con parametros = editar)

    public function platformForm($editing = null, $platform = null) {
        $this->authHelper->checkLoggedIn();
        $this->view->renderPlatformForm($editing,$platform);

    }


    //Agrega una nueva plataforma a la BD
    public function addPlatform() {
        $this->authHelper->checkLoggedIn();
        if(isset($_POST['disponibilidad_ar'])) {
            $disponibilidad_ar = $_POST['disponibilidad_ar'];
        }
        else {
            $disponibilidad_ar = '0';
        }

        if ($this->validateData($_POST)) {
            $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
            $enlace = htmlspecialchars($_POST['enlace'], ENT_QUOTES, 'UTF-8');
            $tipo_contenido = htmlspecialchars($_POST['tipo_contenido'], ENT_QUOTES, 'UTF-8');
            $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
            $link_logo = htmlspecialchars($_POST['link_logo'], ENT_QUOTES, 'UTF-8');
            $id_nueva = $this->model->POSTplatform($nombre, $enlace, $tipo_contenido, $disponibilidad_ar, $precio,$link_logo);
            if ($id_nueva) {
                header("Location:".BASE_URL."plataformas");
            }
            else {
                $this->errorHelper->showError("no se pudo agregar la plataforma.");
            }
        }
        else{
            $this->errorHelper->showError("Deben rellenarse todos los campos del formulario");
            $this->platformForm(false);
        }
    }


    //Elimina una plataforma segun una ID dada
    public function removePlatform($platform_id) {
        $this->authHelper->checkLoggedIn();
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


    //Comprueba que una plataforma exista y llama a su formulario de edicion
    public function editPlatform($platform_id) {
        $this->authHelper->checkLoggedIn();
        $platform = $this->model->getPlatformById($platform_id);
        if ($platform){
            $this->platformForm(true,$platform);
        }
        else{
            $this->errorHelper->showError("Plataforma no encontrada.");
        }
    }


    //Actualiza una plataforma segun una ID dada
    public function updatePlatform($platform_id) {
        $this->authHelper->checkLoggedIn();
        if(isset($_POST['disponibilidad_ar'])) {
            $disponibilidad_ar = $_POST['disponibilidad_ar'];
        }
        else {
            $disponibilidad_ar = '0';
        }

        if ($this->validateData($_POST)) {
            $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
            $enlace = htmlspecialchars($_POST['enlace'], ENT_QUOTES, 'UTF-8');
            $tipo_contenido = htmlspecialchars($_POST['tipo_contenido'], ENT_QUOTES, 'UTF-8');
            $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
            $link_logo = htmlspecialchars($_POST['link_logo'], ENT_QUOTES, 'UTF-8');
            $affectedRows = $this->model->PUTplatform($nombre, $enlace, $tipo_contenido, $disponibilidad_ar, $precio, $platform_id,$link_logo);
            if ($affectedRows>0) {
                header("Location:".BASE_URL."plataformas");
            }
            else {
                $this->errorHelper->showError("no se pudo editar la plataforma.");
            }
        }
        else{
            $this->errorHelper->showError("Deben rellenarse todos los campos del formulario");
            $platform = $this->model->getPlatformById($platform_id);
            $this->platformForm(true,$platform);

        }
    }
}
?>