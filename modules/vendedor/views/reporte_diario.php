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
        <div class="card mt-1 bg-primary">
                <div class="card-header bg-primary text-white">
                    Reporte diario
                </div>
                <div class="card-body bg-white p-0">
                    <div class="card-header m-0">
                        <div class="row" id="">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Vendedor</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaRepDiario">
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <script src="../../js/jquery-3.5.1.slim.min.js"></script>
  <script src="../../js/jquery-ui.js"></script>
  <script src="../../js/popper.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/reportes_.js"></script>
    
  
</body>
</html>