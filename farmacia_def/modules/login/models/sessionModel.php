<?php
    include_once("../../../config/conexion.php");
    class sesionModel extends Model{
        public function get(){
            print("GET");
        }
        public function set(){
            print("SET");
        }
        public function del(){
            print("DEL");
        }
        public function edit(){
            print("EDIT");
        }

        public function checkSession($nivel_acceso, $session = array()){
            $acceso = true;
            foreach($session as $key => $value){
                if($value == ""){
                    $acceso = false;
                }
            }
            if($session['tipo'] != $nivel_acceso){
                $acceso = false;
            }
            if(!$acceso){
                header("location: ../../../index.php");        
            }
        }

        public function checkLogged(){
            session_start();
            if(isset($_SESSION)){
                if($_SESSION['nivel_acceso'] == 1){
                    header("location: modules/admision/views/admision.php");        
                }else if($_SESSION['nivel_acceso'] == 2){
                    header("location: modules/profesionales/views/profesional.php");        
                }
            }
        }

        public function validateUser($user, $contrasenia){
            $contrasenia = md5($contrasenia);
            $this->query = "SELECT nombres, apellidos, tipo, nombre,usuario, usuario.idsucursal FROM usuario INNER JOIN sucursal ON sucursal.idsucursal = usuario.idsucursal WHERE
            usuario = '$user' AND password = '$contrasenia';";
            $this->get_query();
            $data = array();
            foreach ($this->rows as $key => $value) {
                array_push($data, $value);
            }
            return $data;
        }   
        public function cerrarSession(){
            session_start();
            session_destroy();            
        }
        public function __destruct(){
        }
    }
?>