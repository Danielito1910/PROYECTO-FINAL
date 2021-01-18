<?php
include_once("../../../config/conexion.php");
class ventaModel extends Model{
    public function get($data = array()){
        foreach($data as $key=>$value){
            $$key = $value;
        }

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
        $usuario = $_SESSION['usuario'];
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        $this->query = "INSERT INTO venta VALUES (null, '$suma', '$fecha', '$hora', '$usuario', '$dniCliente');";
        $this->set_query();
//        return $this->query;
        return $this->maxVenta()[0]['codVenta'];
    }

    public function setDetalleVenta($precio, $cantidad, $codVenta, $codigoProd){
        $this->query = "INSERT INTO detalleventa VALUES(null, '$precio', '$cantidad', '$codVenta', '$codigoProd');";
        return $this->set_query();
    }

    public function del($data = array()){

    }
    public function maxVenta(){
        $this->query = "SELECT IF(MAX(idventa) is null, '1', MAX(idventa)) as codVenta FROM venta;";
        $this->get_query();
        return $this->rows;
    }
    public function obtenerNumero(){
        $this->query = "SELECT IF(MAX(idventa) is null, '1', MAX(idventa) + 1) as codVenta FROM venta;";
        $this->get_query();
        return json_encode($this->rows);
    }

    public function edit($data = array()){
        foreach($data as $key=>$value){
            if($value == ""){
                return "0";
            }else{
                $$key = $value;
            }
        }

    }
    public function list(){
        // WHERE estado = 'activo'
        session_start();

    }
   public function __destruct(){
    }
}
?>