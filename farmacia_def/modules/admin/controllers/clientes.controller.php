<?php
    include_once '../models/clientes.model.php';
    include_once '../models/utils.model.php';
    if(isset($_POST)){
        $clientes = new clientesModel();
        $utils = new utilsModel();
        //Lista los registros
        if(isset($_POST['list'])){
            echo $clientes->list($_POST);
        }
        if(isset($_POST['dni']) and isset($_POST['nombre']) and isset($_POST['apellidos']) and isset($_POST['direccion']) and isset($_POST['telefono'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $clientes->set($_POST);
        }
        if(isset($_POST['dniUpd']) and isset($_POST['nombreUpd']) and isset($_POST['apellidosUpd']) and isset($_POST['direccionUpd']) and isset($_POST['telefonoUpd'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $clientes->edit($_POST);
        }
        if(isset($_POST['dniCliente']) and isset($_POST['readOne'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $clientes->get($_POST);
        }

    }
?>