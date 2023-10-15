<?php
require_once './app/models/auth.model.php';
require_once './app/views/auth.view.php';
require_once './helpers/error.helper.php';

//Merge reciente
    class AuthController{
        private $model;
        private $view;
        private $errorHelper;

        public function __construct(){
            $this->model = new AuthModel();
            $this->view = new AuthView();
            $this->errorHelper = new ErrorHelper();

        }


        //Muestra el formulario de login
        public function formLogin(){
            $this->view->renderLoginForm();
        }


        //Verifica que los datos del formulario sean correctos e inicia la sesion
        public function login(){
            if ($_POST && !empty($_POST)){
                $nombre = $_POST["username"];
                $contra = $_POST["password"];

                $user = $this->model->getUserByName($nombre);

                if ($user && password_verify($contra,$user->password)){
                    session_start();
                    $_SESSION["logueado"] = true;
                    $_SESSION["username"] = $nombre;
                    $_SESSION["id"] = $user->id_usuario;

                    header("Location:".BASE_URL."home");
                }
                else{
                    $this->view->renderLoginForm();
                    $this->errorHelper->showError("Datos incorrectos");
                }
            }
            else{
                $this->errorHelper->showError("Debe rellenar todos los campos");
            }
        }
        public function logout() {
            //no hago session_start() porque el router se encarga de hacerlo.
            session_destroy();
            header("Location:".BASE_URL."home");
        }
    }