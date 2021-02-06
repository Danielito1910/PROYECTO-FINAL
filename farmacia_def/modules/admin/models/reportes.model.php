<?php
include_once("../../../config/conexion.php");
class reportesModel extends Model{
    public function listDiario($data = array()){
        $this->query = "SELECT sum(total) as total , fecha, hora, concat(nombres, ' ', apellidos) as nombres FROM venta INNER JOIN usuario ON usuario.usuario = venta.usuario group by fecha, nombres ORDER BY nombres,fecha DESC;";
        $this->get_query();
        return json_encode($this->rows);
    }
    public function listMensual($data = array()){
        $this->query = "SELECT sum(total) as total , fecha, hora, concat(nombres, ' ', apellidos) as nombres FROM venta INNER JOIN usuario ON usuario.usuario = venta.usuario group by MONTH(fecha), nombres ORDER BY nombres,fecha DESC;";
        $this->get_query();
        return json_encode($this->rows);
    }
    public function get($data = array()){
    }
    public function set($data = array()){
    }
    public function del($data = array()){
    }
    public function edit($data = array()){
    }
    public function __destruct(){
    }
}
?>