<?php
    include_once('../../login/models/sessionModel.php');
    $auth = new sesionModel();
    session_start();
    $auth->checkSession(1, $_SESSION);
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

        </div>
    </div>

  <script src="../../js/jquery-3.5.1.slim.min.js"></script>
  <script src="../../js/jquery-ui.js"></script>
  <script src="../../js/popper.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
    
  
</body>
</html>