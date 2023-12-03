<?php
require_once "./../includes/users.php";
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
    <!-- Editar:
    - Nombre
    - Nombre de usuario
    - Contraseña
    - Descripción
    - Identidad de género
-->
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

            <label>
                Nombre de usuario
                <input type="text" name="username" id="username" placeholder="nombreusuario">
            </label>

            <label>
                Contraseña
                <input type="text" name="password" id="password" placeholder="Contraseña">
            </label>
            <label>
                Descripción
                <input type="text" name="description" id="description" placeholder="Descripcion">
            </label>

            <label>
                Género
                <input type="text" name="gender" id="gender" placeholder="Genero">
            </label>

            <label>
                Sexo
                <input type="text" name="sex" id="sex" placeholder="Sexo">
            </label>

        </fieldset>
    </form>
</body>

</html>