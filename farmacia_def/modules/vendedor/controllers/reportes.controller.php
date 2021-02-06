<?php
    include_once '../../admin/models/reportes.model.php';
    include_once '../models/utils.model.php';
    if(isset($_POST)){
        $reportes = new reportesModel();
        $utils = new utilsModel();
        //Lista los registros
        if(isset($_POST['diario'])){
            echo $reportes->listDiario($_POST);
        }
        if(isset($_POST['mensual'])){
            echo $reportes->listMensual($_POST);
        }
    }
?>