<?php

    require_once __DIR__.'/conexion.php';

    /**
     * Clase instalacionModel
     * 
     * Modelo para la instalación y configuración inicial del sistema.
     */
    class instalacionModel extends Conexion{

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
         * Comprueba si ya existe al menos un administrador en la base de datos.
         */
        function comprobar_admin(){
            $sql = "SELECT COUNT(".$this->id.") nAdmin FROM ".$this->tabla.";";
            $resultado = $this->conexion->query($sql);
            $fila = $resultado->fetch_assoc();
            if($fila["nAdmin"] > 0)
                return true;
            return false;
        }

        /**
         * Registra un nuevo superadministrador en la base de datos.
         */
        function registrar_admin($nombre,$correo,$pw){
            try{
                $sql = "insert into ".$this->tabla." values
                (default,?,?,?,'s');";
                $stmt = $this->conexion->prepare($sql);
                $pwhash = password_hash($pw, PASSWORD_DEFAULT);

                $stmt->bind_param('sss',$correo,$pwhash,$nombre);
                $stmt->execute();
                return true;
            } catch (mysqli_sql_exception $e) {
                if($e->getCode()==1406)
                    $this->error = "Uno de los campos supera el límite de caracteres.";
                return false;
            } finally {
                $stmt->close();
            }
        }
    }

?>