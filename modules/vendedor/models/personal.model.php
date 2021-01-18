<?php
include_once("../../../config/conexion.php");
class personalModel extends Model{
    public function get($data = array()){
    }
    public function set($data = array()){
    }
    public function del($data = array()){
    }
    public function updatePassword($data = array()){
        foreach($data as $key=>$value){
            $$key = $value;
        }
        session_start();
        $dni = $_SESSION['usuario'];
        $this->query = "UPDATE usuario SET password = md5('$contNueva') WHERE usuario = '$dni';";
        if($this->set_query() === 1){
            $answer['status'] = "ok";
            $answer['result'] = 1;
            return json_encode($answer);
        }else{
            $answer['status'] = "err";
            $answer['result'] = 0;
            return json_encode($answer);
        }
    }
    public function edit($data = array()){
    }

    public function list(){
    }
    public function __destruct(){
    }
}
?>
