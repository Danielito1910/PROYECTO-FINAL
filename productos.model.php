<?php
include_once("../../../config/conexion.php");
class productosModel extends Model{
    public function get($data = array()){
        foreach($data as $key=>$value){
            $$key = $value;
        }
        $this->query = "SELECT * FROM producto WHERE codProducto = '$codigoProducto';";
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
        session_start();
        $idSucursal = $_SESSION['idsucursal'];
        $this->query = "INSERT INTO producto VALUES ('$codProducto', '$nombreProducto', '$composicion', '$marca', '$precio', '$stock', '$idSucursal', '$forma');";
        return json_encode($this->set_query());
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
        $this->query = "UPDATE producto SET nombreProd = '$nombreProductoUpd', composicion = '$composicionUpd', marca = '$marcaUpd', precio = '$precioUpd', stock = '$stockUpd', idforma = '$formaUpd' WHERE codProducto = '$codProductoUpd';";
        return $this->set_query();
    }
    public function list(){
        // WHERE estado = 'activo'
        session_start();
        $codigoSuc = $_SESSION['idsucursal'];
        $this->query = "SELECT producto.*, forma.nombreForma FROM producto INNER JOIN forma ON producto.idForma = forma.idForma WHERE idSucursal = '$codigoSuc' ORDER BY nombreProd;";
        $this->get_query();
        return json_encode($this->rows);
    }
    public function listFormas(){
        // WHERE estado = 'activo'
        session_start();
        $this->query = "SELECT * FROM forma;";
        $this->get_query();
        return json_encode($this->rows);
    }
   public function __destruct(){
    }
}
?>