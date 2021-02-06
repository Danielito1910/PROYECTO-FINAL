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
        @media print{
            .texto_print{
                font-size: 40px;
            }
            .texto_tabla{
                font-size: 30px;
            }
            .tabla_imprimir{
                overflow: auto !important;
                height: auto !important;
            }
            .col-print-12{
                margin-top: 0px;
                width: 100% !important;
            }
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
        <div class="col-print-12 col-sm-10 p-3 texto_print"> 
            <div class="row cabecera font-weight-bold texto_print">
                <div class="col-4 fecha">
                    <span>FECHA:</span>
                    <span id="fecha_text"></span>
                </div>
                <div class="col-4 número_de_venta text-center">
                    <span>N° </span><span class="" id="codVenta"></span>
                </div>
                <div class="col-4 sugerencias d-print-none">
                    sugerencias:
                </div>
            </div>
            <div class="row mt-3 border-bottom d-print-none">
                <div class="col-8">
                    <div class="row">
                        <div class="col-10">
                            <div class="form-group row">
                                <label for="usuario" class="col-sm-3 p-0 pl-1 col-form-label"><small>Nombre del producto:</small></label>
                                <div class="col-sm-9 mt-1">
                                    <input type="text" required class="form-control form-control-sm" id="nombre_para_buscar" placeholder="Escribe el Nombre para buscar">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row" style="min-height: 15px;">
                                <div class="col-4 font-weight-bold border-bottom">Cod. prod: <span id="codProducto">__</span></div>
                                <div class="col-8 font-weight-bold border-bottom">Nombre: <span id="NombreProducto">__</span></div>
                            </div>
                            <div class="row">
                                <div class="col-2 mt-3">Precio: S/.<span id="precio">__</span></div>
                                <div class="col-2 mt-3">Stock: <span id="stock">__</span></div>
                                <div class="col-2 mt-3">Forma: <span id="unidades">__</span></div>
                                <div class="col-4">
                                    <div class="col-11">
                                        <div class="form-group">
                                            <label for="usuario" class="col-sm-12 p-0 pl-1 col-form-label"><small>Cantidad:</small></label>
                                            <div class="col-sm-12 mt-1">
                                                <input type="number" required class="form-control form-control-sm" id="cantidad_producto" value="1" min="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-warning btn-sm mt-3" id="btnAddProducto">Añadir</button>
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row" id="" style="height:100px; overflow: scroll;">
                        <table class="table table-striped table-hover products">
                            <thead>
                                <tr>
                                    <th scope="col" style="padding: 0 !important;margin: 0 !important;">Nombres</th>
                                    <th scope="col" style="padding: 0 !important;margin: 0 !important;">Código</th>
                                </tr>
                            </thead>
                            <tbody id="tablaBusqueda">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="row"><small class="font-weight-bold ml-3">Detalle de venta <span class="d-print-none">(Haga clic para quitar)</span>: </small></div>
                    <div class="row">
                        <div class="col-12 tabla_imprimir" style="height: 200px;overflow:scroll;">
                            <table class="table table-dark table-striped table-hover texto_tabla">
                                <thead>
                                    <tr class="text-center texto_tabla">
                                        <th scope="col">Cod.</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaSucursal" class="border texto_tabla">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-12">
                    <div class="row d-print-none">
                        <label for="usuario" class="col-sm-3 p-0 pl-1 col-form-label"><small>Buscar cliente:</small></label>
                        <div class="col-sm-7 mt-1">
                            <input type="text" required class="form-control form-control-sm" id="nombre_para_buscar_cliente" placeholder="Escribe el Nombre para buscar">
                        </div>
                        <div class="col-2">
                            <a href="./clientes.php" target="_blank" class="btn btn-primary btn-sm">o registrar cliente</a>
                        </div>
                    </div>
                    <div class="row" style="min-height: 15px;">
                        <div class="col-6 border-bottom" id="nombre_cliente"></div>
                        <div class="col-6 border-bottom" id="dni_cliente"></div>                    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <span class="col-sm-7">Dinero entregado:</span> 
                    <div class="col-sm-5 mt-1">
                        <input type="text" required class="form-control form-control-sm text_print" id="dinero_entregado" placeholder="">
                    </div>
                </div>
                <div class="col-3">Vuelto: <span id="vuelto"></span></div>
                <div class="col-3 font-weight-bold">total :   S/.<span id="total">00.00</span></div>
                <div class="col-3 font-weight-bold d-print-none">
                    <button class="btn btn-primary" id="generar_venta">Generar venta</button>
                </div>
            </div>
        </div>
    </div>

  <script src="../../js/jquery-3.5.1.slim.min.js"></script>
  <script src="../../js/jquery-ui.js"></script>
  <script src="../../js/popper.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/ventas_.js"></script>
    
  
</body>
</html>