<?php
    include_once '../models/productos.model.php';
    include_once '../models/utils.model.php';
    if(isset($_POST)){
        $productos = new productosModel();
        $utils = new utilsModel();
        //Lista los registros
        if(isset($_POST['list'])){
            echo $productos->list($_POST);
        }
        if(isset($_POST['listFormas'])){
            echo $productos->listFormas($_POST);
        }
        if(isset($_POST['save'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $productos->set($_POST);
        }
        if(isset($_POST['edit'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $productos->edit($_POST);
        }
        if(isset($_POST['readOne']) and isset($_POST['codigoProducto'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $productos->get($_POST);
        }
    }
?>