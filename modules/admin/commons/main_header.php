<nav class="navbar navbar-expand-lg navbar-dark bg-primary justify-content-between">
    <span class="navbar-brand mb-0 h1">Bienvenido <?php echo $_SESSION['nombres']  . " " . $_SESSION['apellidos'];?></span>
    <form action="../../login/controllers/controller.php" method="POST">
        <input type="submit" class="btn btn-outline-light" name="logout" value="Salir">
    </form>
</nav>