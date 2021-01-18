<?php 
date_default_timezone_set('America/Lima');
abstract class Model{
    private static $db_host    = "localhost:3308";
    private static $db_user    = "root";
    private static $pass       = "1234";
    private static $db         = "farmacia";
    private static $db_charset = "utf8";
    private $conn;
    protected $query;
    protected $rows = array();

    abstract protected function set();
    abstract protected function get();
    abstract protected function del();
    abstract protected function edit();
    private function db_open(){
        $this->conn = new mysqli(
            self::$db_host,
            self::$db_user,
            self::$pass,
            self::$db
        );
        $this->conn->set_charset(self::$db_charset);
    }
    private function db_close(){
        $this->conn->close();
    }
    protected function set_query(){
        $this->db_open();
        $this->conn->query($this->query);
        $affectedRows = $this->conn->affected_rows;
        $this->db_close();
        if ($affectedRows == 1){
            return 1;
        }else{
            return 0;
        }
    }
    protected function get_query(){
        $this->db_open();
        $result = $this->conn->query($this->query);
        while( $this->rows[] = $result->fetch_assoc());
        $result->close();
        $this->db_close();
        return array_pop($this->rows);
    }
    protected function get_json_dt(){
        $this->db_open();
        $result = $this->conn->query($this->query);

        while( $data = mysqli_fetch_assoc($result) ){
            $arreglo["data"][] = $data;
        }
        $result->close();
        $this->db_close();
        return json_encode($arreglo);
    }

}

?>