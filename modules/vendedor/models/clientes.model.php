<?php
include_once("../../../config/conexion.php");
class clientesModel extends Model{
    public function get($data = array()){
        foreach($data as $key=>$value){
            $$key = $value;
        }
        $this->query = "SELECT * FROM cliente WHERE dni = '$dniCliente' LIMIT 1;";
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
        $this->query = "INSERT INTO cliente VALUES('$dni', '$nombre', '$apellidos', '$direccion', '$telefono');";
        return $this->set_query();
    }
    public function del($data = array()){

    }

    public function edit($data = array()){
        foreach($data as $key=>$value){
            if($value == ""){
                return "0";
            }else{
                $$key = $value;
            }
        }
        $this->query = "UPDATE cliente SET nombre = '$nombreUpd', apellidos = '$apellidosUpd', direccion = '$direccionUpd', telefono = '$telefonoUpd' WHERE dni = '$dniUpd';";
        return $this->set_query();
    }

    public function list(){
        // WHERE estado = 'activo'
        $this->query = "SELECT * FROM cliente;";
        $this->get_query();
        return json_encode($this->rows);
    }
    public function __destruct(){
    }
    public function getOne($data = array()){
        foreach($data as $key=>$value){
            $$key = $value;
        }
        if($nombrePersona == ""){
            $this->query = "SELECT * FROM cliente WHERE concat(nombre, ' ',apellidos) LIKE '------' LIMIT 1;";
        }else{
            $this->query = "SELECT * FROM cliente WHERE concat(nombre, ' ',apellidos) LIKE '%$nombrePersona%' LIMIT 1;";
        }

        $this->get_query();
        return json_encode($this->rows);
    }
}
?>