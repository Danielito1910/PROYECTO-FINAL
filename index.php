<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./modules/css/bootstrap.min.css">
    <link rel="stylesheet" href="./modules/css/style.css">
    <title>Bienvenido</title>
</head> 
<body>
<?php
  require_once './commons/header_login.php';
?>
    <main id="header">
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-6">
            <div class="header-content-left" style="box-shadow:  20px 20px 40px #d9d9d9, 
             -20px -20px 40px #ffffff;">
              <img src="./modules/imagenes/sumaq_kawsay.jpg" alt="Logo" style="width: 100%;">
            </div>    
          </div>
          <div class="col-md-6">
            <div class="header-content-right">
              <h1 class="text-center">
                Bienvenido
                <br>
              </h1>
              <h4 class="text-center d-none">CÓDIGO: <span id="codigoIpress"></span></h3>
              <p class="mt-5">
                <form class="form-signin" method="post" id="mainForm">
                    <div class="form-label-group">
                        <input type="text" id="inputDocumento" class="form-control" name="usuario" required autocomplete="username">
                        <label for="inputDocumento">Usuario</label>
                    </div>
                    <div class="form-label-group mt-4">
                        <input type="password" id="inputPassword" class="form-control" name="contrasenia" required="" autocomplete="current-password">
                        <label for="inputPassword">Contraseña</label>
                    </div>
                    <div class="col-3 mx-auto mt-3">
                        <button class="btn btn-primary" type="submit">Ingresar</button>
                    </div>
                    <div class="col-12 mt-3" id="userIncorrecto">
                    </div>
                </form>
              </p>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer class="footer navbar-fixed-bottom bg-primary text-white" style="position:absolute; bottom:0;width: 100%;">
      <div class="footer-copyright text-center py-3">
      </div>
    </footer>
    <!-- Footer -->
    <script src="./modules/js/jquery-3.5.1.slim.min.js"></script>
    <script src="./modules/js/popper.min.js"></script>
    <script src="./modules/js/bootstrap.min.js"></script>
    <script src="./modules/js/auth.js"></script>
</body>
</html>