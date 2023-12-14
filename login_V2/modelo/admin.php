<?php

    require_once __DIR__.'/conexion.php';

    /**
     * Clase adminModel
     * 
     * Modelo para la gestión de administradores.
     */
    class adminModel extends Conexion{

        private $tabla;
        private $id;
        private $correo;
        private $pw;
        private $nombre;
        private $perfil;
        public $error;

        /**
         * Constructor de la clase.
         * 
         * Inicializa las propiedades de la clase y llama al constructor de la clase padre (Conexion).
         */
        public function __construct() {
            parent::__construct();
            $this->tabla = "us_admin";
            $this->id = "id";
            $this->correo = "correo";
            $this->pw = "pw";
            $this->nombre = "nombre";
            $this->perfil = "perfil";
        }

        /**
         * Registra un nuevo administrador en la base de datos.
         */
        function registrar_admin($nombre,$correo,$pw){
            try{
                $sql = "insert into ".$this->tabla." values
                (default,?,?,?,'am');";
                $stmt = $this->conexion->prepare($sql);
                $pwhash = password_hash($pw, PASSWORD_DEFAULT);
                $stmt->bind_param('sss',$correo,$pwhash,$nombre);
                $stmt->execute();
                return true;
            } catch (mysqli_sql_exception $e) {
                if($e->getCode()==1406)
                    $this->error = "Supera el límite de caracteres.";
                if($e->getCode()==1062)
                    $this->error = "Usuario ya existente con ese nombre o correo.";
                return false;
            } finally {
                $stmt->close();
            }
        }
    }

?>