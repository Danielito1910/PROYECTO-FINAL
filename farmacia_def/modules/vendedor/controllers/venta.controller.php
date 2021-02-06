<?php
    include_once '../models/venta.model.php';
    include_once '../models/utils.model.php';
    if(isset($_POST)){
        $venta = new ventaModel();
        $utils = new utilsModel();
        //Lista los registros
        if(isset($_POST['numeroVenta'])){
            echo $venta->obtenerNumero($_POST);
        }

        if(isset($_POST['info']) and isset($_POST['dniCliente'])){
            $info = json_decode($_POST['info']);
            if(sizeof($info) == 0){
                echo $data["status"] = "err";
            }else{
                //registrar la venta y obtener el último id insertado
                $suma = 0;
                foreach($info as $key=>$value){
                    $suma += $value[4];
                }

                //registrar venta
                $datos['dniCliente'] = $_POST['dniCliente'];
                $datos['suma'] = $suma;
                $codVenta = $venta->set($datos);
                /*
                    [0] => 10
                    [1] => Paracetamol
                    [2] => 1
                    [3] => 15.50
                    [4] => 15.50
                */
                foreach($info as $key=>$value){
                    echo $venta->setDetalleVenta($value[3], $value[2], $codVenta, $value[0]);
                }
            }
        }

    }
?>