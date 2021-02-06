<?php
    include_once '../models/personal.model.php';
    include_once '../models/utils.model.php';
    if(isset($_POST)){
        $personal = new personalModel();
        $utils = new utilsModel();
        //Lista los registros
        if(isset($_POST['list'])){
            echo $personal->list($_POST);
        }
        if(isset($_POST['save'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $personal->set($_POST);
        }
        if(isset($_POST['edit'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $personal->edit($_POST);
        }
        if(isset($_POST['codigoPersona']) and isset($_POST['readOne'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $personal->get($_POST);
        }
        if(isset($_POST['usuarioUpd']) and isset($_POST['delete'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $personal->del($_POST);
        }
    }
?>