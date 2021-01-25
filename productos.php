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
            <div class="card mt-1 bg-primary">
                <div class="card-header bg-primary text-white">
                    Productos
                </div>
                <div class="card-body bg-white p-0">
                    <div class="card-header m-0">
                        <div class="row">
                            <div class="border m-1">
                                <button type="button" href="#modalAgregarProducto" class="btn btn-settings" data-backdrop="true" data-toggle="modal" type="button" id="btnAddUsuario">
                                    <img src="../../imagenes/svg/file-earmark-plus.svg" class="" alt="" width="15" height="15" title="I">
                                    <br>
                                    Nuevo
                                </button>
                            </div>
                            <div class="border m-1">
                                <button type="button" class="btn" id="btnReload">
                                    <img src="../../imagenes/svg/bootstrap-reboot.svg" class="text-primary" alt="" width="15" height="15" title="I">
                                    <br>
                                    Actualizar
                                </button>
                            </div>

                            <div class="m-1" id="showMessage">

                            </div>
                        </div>
                        <div class="row" id="">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Código de producto</th>
                                    <th scope="col">nombre</th>
                                    <th scope="col">composición</th>
                                    <th scope="col">marca</th>
                                    <th scope="col">precio</th>
                                    <th scope="col">stock</th>
                                    <th scope="col">Forma</th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="tablaProductos">
                                    
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--Modal agregar usuario-->
<div id="modalAgregarProducto" class="modal fade">
    <div class="modal-dialog" id="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header modal-header-height">
                <span class="modal-title text-white" id="usuarioModalLabel"><small><b>Agregar producto.</b></small></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="formularioProducto" >
                <div class="modal-body">
                    <fieldset class=" mx-1 px-2 py-0 border text-primary">
                        <legend class="scheduler-border">Datos del producto: </legend>
                        <div class="control-group">
                            <div class="form-group row">
                                <label for="codProducto" class="col-sm-3 p-0 pl-1 col-form-label"><small>Código del producto:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="text" required class="form-control form-control-sm" id="codProducto" name="codProducto">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nombreProducto" class="col-sm-3 p-0 pl-1 col-form-label"><small>Nombre del producto:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="text" required class="form-control form-control-sm" id="nombreProducto" name="nombreProducto">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="composicion" class="col-sm-3 p-0 pl-1 col-form-label"><small>Composición:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="text" required class="form-control form-control-sm" id="composicion" name="composicion">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="marca" class="col-sm-3 p-0 pl-1 col-form-label"><small>Marca:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="text" required class="form-control form-control-sm" name="marca" id="marca">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="precio" class="col-sm-3 p-0 pl-1 col-form-label"><small>Precio:</small></label>
                                <div class="col-sm-5 mt-2">
                                    <input type="text" required class="form-control form-control-sm" name="precio" id="precio"  onkeypress='return validaNumericos(event)' onkeypress="return validaNumericos(event);">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="precio" class="col-sm-3 p-0 pl-1 col-form-label"><small>Stock:</small></label>
                                <div class="col-sm-5 mt-2">
                                    <input type="text" required class="form-control form-control-sm" name="stock" id="stock"  onkeypress='return validaNumericos(event)' onkeypress="return validaNumericos(event);">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="forma" class="col-sm-3 p-0 pl-1 col-form-label"><small>Forma:</small></label>
                                <div class="col-sm-5 mt-2">
                                    <select name="forma" id="forma" required class="form-control form-control-sm" >
                                    </select>
                                </div>
                            </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--Modal editar usuario-->
<div id="modalEditarProducto" class="modal fade">
    <div class="modal-dialog" id="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header modal-header-height">
                <span class="modal-title text-white" id="usuarioModalLabel"><small><b>Editar producto.</b></small></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="formularioProductoUpd" >
                <div class="modal-body">
                    <fieldset class=" mx-1 px-2 py-0 border text-primary">
                        <legend class="scheduler-border">Datos del producto: </legend>
                        <div class="control-group">
                            <div class="form-group row">
                                <label for="codProductoUpd" class="col-sm-3 p-0 pl-1 col-form-label"><small>Código del producto:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="text" required class="form-control form-control-sm" id="codProductoUpd" name="codProductoUpd" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nombreProductoUpd" class="col-sm-3 p-0 pl-1 col-form-label"><small>Nombre del producto:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="text" required class="form-control form-control-sm" id="nombreProductoUpd" name="nombreProductoUpd">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="composicionUpd" class="col-sm-3 p-0 pl-1 col-form-label"><small>Composición:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="text" required class="form-control form-control-sm" id="composicionUpd" name="composicionUpd">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="marcaUpd" class="col-sm-3 p-0 pl-1 col-form-label"><small>Marca:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="text" required class="form-control form-control-sm" name="marcaUpd" id="marcaUpd">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="precio" class="col-sm-3 p-0 pl-1 col-form-label"><small>Precio:</small></label>
                                <div class="col-sm-5 mt-2">
                                    <input type="text" required class="form-control form-control-sm" name="precioUpd" id="precioUpd"  onkeypress='return validaNumericos(event)' onkeypress="return validaNumericos(event);">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="precioUpd" class="col-sm-3 p-0 pl-1 col-form-label"><small>Stock:</small></label>
                                <div class="col-sm-5 mt-2">
                                    <input type="text" required class="form-control form-control-sm" name="stockUpd" id="stockUpd"  onkeypress='return validaNumericos(event)' onkeypress="return validaNumericos(event);">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="formaUpd" class="col-sm-3 p-0 pl-1 col-form-label"><small>Forma:</small></label>
                                <div class="col-sm-5 mt-2">
                                    <select name="formaUpd" id="formaUpd" required class="form-control form-control-sm" >
                                    </select>
                                </div>
                            </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>





  <script src="../../js/jquery-3.5.1.slim.min.js"></script>
  <script src="../../js/jquery-ui.js"></script>
  <script src="../../js/popper.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/productos_.js"></script>
  
</body>
</html>