<?php
include_once("../../../config/conexion.php");
class farmaciaModel extends Model{
    public function get($data = array()){
        foreach($data as $key=>$value){
            if($value == ""){
                return "0";
            }else{
                $$key = $value; 
            }
        }
        $this->query = "SELECT * FROM sucursal WHERE idsucursal = '$codigoSucursal' LIMIT 1;";
        $this->get_query();
        $data = array();
        return json_encode($this->rows);
    }
    public function list(){
        $this->query = "SELECT * FROM sucursal;";
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
        $this->query = "INSERT INTO sucursal VALUES (null, '$nombre', '$direccion', '$telefono');";
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
        $this->query = "DELETE FROM sucursal WHERE idsucursal = '$idsucursal';";
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
        $this->query = "UPDATE sucursal SET nombre = '$nombreUpd', direccion = '$direccionUpd', celular = '$telefonoUpd' WHERE idsucursal = '$codSucursal';";
        return json_encode($this->set_query());
    }
    public function __destruct(){
    }
}
?>