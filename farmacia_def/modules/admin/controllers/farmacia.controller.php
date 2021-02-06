<?php
    include_once '../models/farmacia.model.php';
    include_once '../models/utils.model.php';
    if(isset($_POST)){
        $farmacia = new farmaciaModel();
        $utils = new utilsModel();
        //retorna el primer registro 
        if(isset($_POST["list"])){
            echo $farmacia->list();
        }
        if(isset($_POST["set"])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $farmacia->set($_POST);
        }
        if(isset($_POST["idsucursal"]) and isset($_POST['delete'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $farmacia->del($_POST);
        }
        if(isset($_POST["codigoSucursal"]) and isset($_POST['readOne'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $farmacia->get($_POST);
        }
        if(isset($_POST["edit"])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $farmacia->edit($_POST);
        }

    }


?>