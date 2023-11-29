<?php
require_once ""
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="estilos.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario | Gymbrogains</title>
</head>

<body>
    <h1>EDITAR USUARIO</h1>
    <form action="modificar.php" method="post">
        <div>id_cliente:<input type="text" name="id_cliente" size="20" maxlength="20" value="" placeholder="clave del cliente" aling="rigth" required autofocus></div><br>
        <div>nombre:<input type="text" name="nombre" size="20" maxlength="20" value="" placeholder="nombre del cliente" aling="rigth" required autofocus></div><br>
        <div>direccion:<input type="text" name="direccion" size="20" maxlength="20" value="" placeholder="direccion del cliente" aling="rigth" required autofocus></div><br>
        <div>telefono:<input type="text" name="telefono" size="20" maxlength="20" value="" placeholder="telefono del cliente" aling="rigth" required autofocus></div><br>
        <input class="in" type="submit" name="modificar" id="test" value="modificar">
    </form>

    <form action="">
        <fieldset>
            <legend>Editar usuario</legend>

            <label>
                Nombre
                <input type="text" name="name" id="name" placeholder="Nombre" required>
            </label>

            <label>
                Apellido
                <input type="text" name="lastname" id="lastname" placeholder="Apellido" required>
            </label>
        </fieldset>
    </form>
</body>

</html>