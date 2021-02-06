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
                    Clientes
                </div>
                <div class="card-body bg-white p-0">
                    <div class="card-header m-0">
                        <div class="row">
                            <div class="border m-1">
                                <button type="button" href="#modalAgregarUsuario" class="btn btn-settings" data-backdrop="true" data-toggle="modal" type="button" id="btnAddUsuario">
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
                                    <th scope="col">Documento</th>
                                    <th scope="col">Apellidos y nombres</th>
                                    <th scope="col">Dirección</th>
                                    <th scope="col">Teléfono</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaClientes">
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--Modal agregar usuario-->
<div id="modalAgregarUsuario" class="modal fade">
    <div class="modal-dialog" id="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header modal-header-height">
                <span class="modal-title text-white" id="usuarioModalLabel"><small><b>Agregar usuario.</b></small></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="formularioClientes" >
                <div class="modal-body">
                    <fieldset class=" mx-1 px-2 py-0 border text-primary">
                        <legend class="scheduler-border">Datos personales del Cliente: </legend>
                        <div class="control-group">
                            <div class="form-group row">
                                <label for="dni" class="col-sm-3 p-0 pl-1 col-form-label"><small>DNI:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="text" required class="form-control form-control-sm" id="dni" name="dni" maxlength="8" minlength="8 " onkeypress="return validaNumericos(event);">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nombre" class="col-sm-3 p-0 pl-1 col-form-label"><small>Nombre(s):</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="text" required class="form-control form-control-sm" id="nombre" name="nombre">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="apellidos" class="col-sm-3 p-0 pl-1 col-form-label"><small>Apellidos:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="text" required class="form-control form-control-sm" id="apellidos" name="apellidos">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="direccion" class="col-sm-3 p-0 pl-1 col-form-label"><small>Dirección:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="mail" required class="form-control form-control-sm" name="direccion" id="direccion">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="telefono" class="col-sm-3 p-0 pl-1 col-form-label"><small>Celular:</small></label>
                                <div class="col-sm-5 mt-2">
                                    <input type="text" required class="form-control form-control-sm" name="telefono" id="telefono"  onkeypress='return validaNumericos(event)' minlength="9" maxlength="9"  onkeypress="return validaNumericos(event);">
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
<div id="modalEditarUsuario" class="modal fade">
    <div class="modal-dialog" id="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header modal-header-height">
                <span class="modal-title text-white" id="usuarioEditarLabel"><small><b>Editar usuario.</b></small></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="formularioUpdClientes" >
                <div class="modal-body">
                    <fieldset class=" mx-1 px-2 py-0 border text-primary">
                        <legend class="scheduler-border">Datos personales del Cliente: </legend>
                        <div class="control-group">
                            <div class="form-group row">
                                <label for="dniUpd" class="col-sm-3 p-0 pl-1 col-form-label"><small>DNI:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="text" required class="form-control form-control-sm" id="dniUpd" name="dniUpd" maxlength="8" minlength="8 " onkeypress="return validaNumericos(event);" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nombreUpd" class="col-sm-3 p-0 pl-1 col-form-label"><small>Nombre(s):</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="text" required class="form-control form-control-sm" id="nombreUpd" name="nombreUpd">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="apellidosUpd" class="col-sm-3 p-0 pl-1 col-form-label"><small>Apellidos:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="text" required class="form-control form-control-sm" id="apellidosUpd" name="apellidosUpd">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="direccionUpd" class="col-sm-3 p-0 pl-1 col-form-label"><small>Dirección:</small></label>
                                <div class="col-sm-9 mt-2">
                                    <input type="mail" required class="form-control form-control-sm" name="direccionUpd" id="direccionUpd">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="telefonoUpd" class="col-sm-3 p-0 pl-1 col-form-label"><small>Celular:</small></label>
                                <div class="col-sm-5 mt-2">
                                    <input type="text" required class="form-control form-control-sm" name="telefonoUpd" id="telefonoUpd"  onkeypress='return validaNumericos(event)' minlength="9" maxlength="9"  onkeypress="return validaNumericos(event);">
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
  <script src="../../js/clientes_.js"></script>
  
</body>
</html>