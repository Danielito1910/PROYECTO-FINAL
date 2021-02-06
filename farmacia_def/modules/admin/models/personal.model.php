<?php
include_once("../../../config/conexion.php");
class personalModel extends Model{
    public function get($data = array()){
        foreach($data as $key=>$value){
            if($value == ""){
                return "0";
            }else{
                $$key = $value; 
            }
        }
        $this->query = "SELECT usuario, nombres, apellidos, telefono, tipo FROM usuario WHERE usuario = '$codigoPersona' LIMIT 1;";
        $this->get_query();
        return json_encode($this->rows); 
    }
    public function set($data = array()){
        foreach($data as $key=>$value){
            if($value == ""){
                return "0";
            }else{
                $$key = $value; 
            }
        }
        $this->query = "INSERT INTO usuario VALUES ('$usuario', md5('$usuario'), '$nombre', '$apellidos', '$telefono', '$tipo', '$sucursal');";
        return json_encode($this->set_query());
    }
    public function del($data = array()){
        foreach($data as $key=>$value){
            if($value == ""){
                return "0";
            }else{
                $$key = $value; 
            }
        }
        $this->query = "DELETE FROM usuario WHERE usuario = '$usuarioUpd';";
        return json_encode($this->set_query());        
    }
    public function edit($data = array()){
        foreach($data as $key=>$value){
            if($value == ""){
                return "0";
            }else{
                $$key = $value; 
            }
        }
        $this->query = "UPDATE usuario SET nombres = '$nombreUpd', apellidos = '$apellidosUpd', telefono = '$telefonoUpd', tipo = '$tipoUpd', idsucursal = '$sucursalUpd' WHERE usuario = '$usuarioUpd';";
        return json_encode($this->set_query());
    }
    public function list(){
        session_start();
        $codigoSucursal = $_SESSION['idsucursal'];
        $this->query = "SELECT * FROM usuario WHERE idsucursal = '$codigoSucursal';";
        $this->get_query();
        return json_encode($this->rows);
    }

    public function __destruct(){
    }
}
?>