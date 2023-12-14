<?php

    require_once __DIR__.'/../modelo/instalacion.php';

    /**
     * Clase instalacionController
     * 
     * Controlador para el proceso de instalación y registro de administradores.
     */
    class instalacionController {

        public $titulo;
        public $view;
        public $modelo;

        /**
         * Constructor de la clase.
         * 
         * Inicializa las propiedades de la clase, crea una instancia del modelo instalacionModel
         * y comprueba si ya existe un administrador.
         */
        public function __construct() {
            $this->view = "instalacion"; 
            $this->titulo = "Instalación"; 
            $this->modelo = new instalacionModel(); 
            $this->comprobar_existe_admin(); 
        }

        /**
         * Comprueba si ya existe un administrador.
         */
        function comprobar_existe_admin(){
            if($this->modelo->comprobar_admin()){
                $this->view = "inicio_sesion";
                $this->titulo = "Inicio de sesion";
                return true;
            }
            return false;
        }

        /**
         * Registra un nuevo administrador si no existe uno previamente.
         */
        function registrar_admin(){
            if(!$this->comprobar_existe_admin()){
                $nombre = $_POST["nombre"];
                $correo = $_POST["correo"];
                $pw = $_POST["pw"];
                
                // Validación de campos antes de registrar
                if($this->validar_campos($nombre,$correo,$pw)){
                    $resultado = $this->modelo->registrar_admin($nombre,$correo,$pw);
                    
                    if($resultado){
                        $this->view = "inicio_sesion";
                        $this->titulo = "Inicio de sesion";
                    } else {
                        $_GET["error"] = $this->modelo->error;
                    }
                }
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