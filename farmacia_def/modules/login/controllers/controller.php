<?php 
    include_once '../models/sessionModel.php';
    if(isset($_POST)){
        $sesion = new sesionModel();
        if(isset($_POST["usuario"]) && isset($_POST["contrasenia"])){
            $user = htmlspecialchars(strip_tags($_POST["usuario"], ENT_QUOTES));
            $pass = htmlspecialchars(strip_tags($_POST["contrasenia"], ENT_QUOTES));
            $data = $sesion->validateUser($user, $pass);
            if(sizeof($data) == 1){
                session_start();
                foreach($data[0] as $key=>$value){
                    $_SESSION[$key] = $value;
                }
                echo json_encode($data[0]['tipo']);
            }else{
                echo json_encode("err");
            }
        }

        

        if(isset($_POST['logout'])){
            $sesion->cerrarSession();
            header('location:../../../');
        }
    }