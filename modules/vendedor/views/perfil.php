<?php
    include_once('../../login/models/sessionModel.php');
    $auth = new sesionModel();
    session_start();
    $auth->checkSession(2, $_SESSION);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link href='../../css/main.css' rel='stylesheet' />
    <link href='../../css/general_css.css' rel='stylesheet' />
    <title>Inicio</title>
    <style>
        .modal-lg {
            max-width: 80% !important;
        }
        .fc-title{
            font-size: 5em;
        }
    </style>
</head>
<body>

<?php
    include_once '../commons/main_header.php';
?>
    <div class="d-flex background-primary">
        <div class="col-sm-2 border-right flex-column justify-content-center d-print-none">
            <?php
                include_once '../includes/menu.php';
            ?>
        </div>
        <div class="col-sm-10">
            <div id="alert-conf">
            
            </div>
            <form method="POST" id="updatePassword" >
                <div class="card-body1">
                    <fieldset class=" mx-1 px-2 py-0 border text-primary">
                        <legend class="scheduler-border">Cambiar contraseña: </legend>
                        <div class="control-group">
                            <div class="form-group row pl-2">
                                <label for="tipoDoc" class="col-sm-3 p-0 pl-1 col-form-label"><small>Nueva contraseña:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="password" required class="form-control form-control-sm" id="contNueva" name="contNueva" >
                                </div>
                            </div>
                            <div class="form-group row pl-2">
                                <label for="tipoDoc" class="col-sm-3 p-0 pl-1 col-form-label"><small>Confirmar contraseña:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="password" required class="form-control form-control-sm" id="confContra">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>

  <script src="../../js/jquery-3.5.1.slim.min.js"></script>
  <script src="../../js/jquery-ui.js"></script>
  <script src="../../js/popper.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/perfil_.js"></script>
    
  
</body>
</html>