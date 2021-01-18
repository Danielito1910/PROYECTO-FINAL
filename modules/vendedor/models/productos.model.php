<?php
include_once("../../../config/conexion.php");
class productosModel extends Model{
    public function get($data = array()){

    }
    public function set($data = array()){

    }
    public function del($data = array()){

    }

    public function edit($data = array()){

    }
    public function listBusqueda($textoABuscar){
        session_start();
        $codigoSuc = $_SESSION['idsucursal'];
        if($textoABuscar == ""){
            $this->query = "SELECT * FROM producto INNER JOIN forma ON producto.idforma = forma.idforma WHERE idsucursal = '$codigoSuc' AND nombreProd LIKE '------';";
        }else{
            $this->query = "SELECT * FROM producto INNER JOIN forma ON producto.idforma = forma.idforma WHERE idsucursal = '$codigoSuc' AND nombreProd LIKE '%$textoABuscar%';";
        }
        $this->get_query();
        return json_encode($this->rows);
    }
    public function listBusquedaProd($codigoProducto){
        session_start();
        $codigoSuc = $_SESSION['idsucursal'];
        $this->query = "SELECT * FROM producto INNER JOIN forma ON producto.idforma = forma.idforma WHERE idsucursal = '$codigoSuc' AND codProducto = '$codigoProducto' LIMIT 1;";
        $this->get_query();
        return json_encode($this->rows);
    }
   public function __destruct(){
    }
}
?>