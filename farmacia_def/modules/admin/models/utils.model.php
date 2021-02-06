<?php
    class utilsModel{
        /*Función para remover caracteres especiales de una consulta mysql*/
        function real_escape($str){
            global $con;
            $escape = mysqli_real_escape_string($con,$str);
            return $escape;
        }
        /*Funcion para remover caracteres html*/
        function remove_junk($str){
            $str = nl2br($str);
            $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
            return $str;
        }

        public function __destruct(){
        }
    }
?>