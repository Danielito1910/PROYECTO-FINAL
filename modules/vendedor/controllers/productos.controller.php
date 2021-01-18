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
        if(isset($_POST['textoABuscar'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $productos->listBusqueda($_POST['textoABuscar']);
        }
        if(isset($_POST['codigoProducto'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $productos->listBusquedaProd($_POST['codigoProducto']);
        }
    }
?>