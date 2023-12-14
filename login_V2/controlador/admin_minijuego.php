<?php
    /**
     * Clase admin_minijuegoController
     * 
     * Controlador para la administración de minijuegos.
     */
    class admin_minijuegoController {

        public $titulo;
        public $view;

        /**
         * Constructor de la clase.
         * Inicializa las propiedades de la clase.
         */
        public function __construct() {
            $this->view = "admin_minijuego"; // Asigna la vista 'admin_minijuego'
            $this->titulo = "Administrador minijuegos"; // Asigna el título 'Administrador minijuegos'
        }
    }
?>