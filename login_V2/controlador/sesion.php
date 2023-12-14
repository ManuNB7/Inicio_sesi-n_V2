<?php

    require_once __DIR__.'/../modelo/sesion.php';

    /**
     * Clase sesionController
     * 
     * Controlador para la gestión de sesiones de usuario.
     */
    class sesionController {

        public $titulo;
        public $modelo;
        public $view;

        /**
         * Constructor de la clase.
         * 
         * Inicializa las propiedades de la clase y crea una instancia del modelo sesionModel.
         */
        public function __construct() {
            $this->modelo = new sesionModel();
            $this->view = "inicio_sesion"; 
            $this->titulo = "Inicio de sesion";
        }

        /**
         * Inicia sesión con el nombre de usuario y contraseña proporcionados.
         */
        function inicio_sesion(){
            $nombre = $_POST["nombre"];
            $pw = $_POST["pw"];
            
            // Validación antes de iniciar sesión
            if($this->validar($nombre,$pw)){
                if($this->modelo->comprobar_usuario($nombre,$pw)){
                    $this->redirigir_perfil($_SESSION["perfil"]);
                } else {
                    $_GET["error"] = $this->modelo->error;
                }
            }
        }

        /**
         * Valida si los campos del formulario no están vacíos.
         */
        function validar($nombre, $pw){
            if(empty($nombre)||empty($pw)){
                $_GET["error"] = "Debes rellenar el nombre y la contraseña";
                return false;
            }
            return true;
        }

        /**
         * Redirige al usuario según su perfil después de iniciar sesión.
         */
        function redirigir_perfil($perfil){
            switch ($perfil) {
                case 's':
                    header('Location: index.php?controller=admin');
                    break;
                case 'a':
                    header('Location: index.php?controller=admin_minijuego');
                    break;
            }
        }

        /**
         * Cierra la sesión del usuario.
         */
        function cerrar_sesion(){
            $_SESSION = array();
        }
    }

?>