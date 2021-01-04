<!DOCTYPE html>
<html lang="es">
<head>
    <?php 

        $mysqli = new mysqli("127.0.0.1:3360", "root", "", "persona");

    
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <h5>Nombre: </h5>
        <input type="text" name="nombre" placeholder="Nombre">
        <br>
        <h5>Tipo de documento:</h5>
        <select name="tipo_doc">
            <option value="DNI">DNI</option>
            <option value="CARNET DE EXTRANJERÍA">CARNET DE EXTRANJERÍA</option>
            <option value="PASAPORTE">PASAPORTE</option>
        </select>
        <br>
        <h5>Animales favoritos:</h5>
        <input type="checkbox" checked name="animales[]" value="Perro">
        <label for="vehicle1">Perro</label><br>
        <input type="checkbox" name="animales[]" value="Gato">
        <label for="vehicle2">Gato</label><br>
        <input type="checkbox" name="animales[]" value="Conejo">
        <label for="vehicle3">Conejo</label><br>
        <h5>Género: </h5>
        <input type="radio" checked name="genero" value="M">
        <label for="male" >Hombre</label><br>
        <input type="radio" name="genero" value="F">
        <label for="female">Mujer</label><br>
        <br>
        <h5>Color favorito:</h5>
        <input type="color" name="color">
        <br>
        <br>
        <input type="submit" value="Guardar">
    </form>


    <hr>
    <?php 
        if(isset($_POST['nombre'])){
            foreach($_POST as $key =>$value){
                $$key = clean($value);
            }
            $animales = implode( "-",$_POST['animales']);
            $query = "INSERT INTO usuario VALUES (null, '$nombre', '$genero', '$animales', '$tipo_doc', '$color')";
            $mysqli->query($query);
        }


        function clean($string) {
            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
            return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        }


        $consulta = "SELECT * FROM usuario ORDER by id DESC;";
        if ($resultado = $mysqli->query($consulta)) {
            /* obtener el array de objetos */
            echo "<table border='1';>";
            echo " <tr>
            <td><strong>id</strong></td>
            <td><strong>nombre</strong></td>
            <td><strong>género</strong></td>
            <td><strong>animales favoritos</strong></td>
            <td><strong>tipo de documento</strong></td>
            <td><strong>color favorito</strong></td>
          </tr> ";
            while ($fila = $resultado->fetch_row()) {
                echo " 
                    <tr>
                        <td>$fila[0]</td>
                        <td>$fila[1]</td>
                        <td>$fila[2]</td>
                        <td>$fila[3]</td>
                        <td>$fila[4]</td>
                        <td><div style='background: #$fila[5]; color:#$fila[5]; '>d</div></td>
                    </tr>
                
                
                ";
            }

            /* liberar el conjunto de resultados */
            $resultado->close();
        }


    ?>

</body>
</html>