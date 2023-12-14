<?php

    require_once __DIR__.'/../modelo/admin.php';

    /**
     * Clase adminController
     * 
     * Controlador para la gestión de súper administradores.
     */
    class adminController {

        public $titulo;
        public $view;
        public $modelo;

        /**
         * Constructor de la clase.
         * 
         * Inicializa las propiedades de la clase y crea una instancia del modelo adminModel.
         */
        public function __construct() {
            $this->view = "admin"; 
            $this->titulo = "Super administrador"; 
            $this->modelo = new adminModel(); 
        }

        /**
         * Cambia la vista y el título para mostrar el formulario de registro de administradores.
         */
        function mostrar_registro(){
            $this->view = "registro_admin";
            $this->titulo = "Registro administradores";
        }

        /**
         * Registra un nuevo administrador utilizando datos del formulario POST.
         */
        function registrar_admin(){
            $nombre = $_POST["nombre"];
            $correo = $_POST["correo"];
            $pw = $_POST["pw"];
            
            // Validación de campos antes de registrar
            if($this->validar_campos($nombre,$correo,$pw)){
                $resultado = $this->modelo->registrar_admin($nombre,$correo,$pw);
                
                if($resultado){
                    $this->view = "admin";
                    $this->titulo = "Super administrador";
                    $_GET["exito"] = "Administrador añadido con éxito";
                } else {
                    $_GET["error"] = $this->modelo->error;
                    $this->view = "registro_admin";
                    $this->titulo = "Registro administradores";
                }
            } else{
                $this->view = "registro_admin";
                $this->titulo = "Registro administradores";
            }
        }

        /**
         * Valida si los campos del formulario no están vacíos.
         */
        function validar_campos($nombre,$correo,$pw){
            if(empty($nombre)||empty($correo)||empty($pw)){
                $_GET["error"] = "Debes rellenar el correo, el nombre y la contraseña";
                return false;
            }
            return true;
        }
    }

?>