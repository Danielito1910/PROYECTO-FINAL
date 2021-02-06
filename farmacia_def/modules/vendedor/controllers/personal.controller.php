<?php
    include_once '../models/personal.model.php';
    include_once '../models/utils.model.php';
    if(isset($_POST)){
        $personal = new personalModel();
        $utils = new utilsModel();

        if(isset($_POST['updatePass'])){
            foreach($_POST as $key=>$value){
                $_POST[$key] = $utils->remove_junk($value);
            }
            echo $personal->updatePassword($_POST);
        }
    }
?>



