<?php include('../templates/header.html'); ?>



<form action="controlador_signin.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username"><br>
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre"><br>
    <label for="direccion">Direccion:</label>
    <input type="text" name="direccion"><br>
    <label for="correo">Correo:</label>
    <input type="text" name="correo"><br>
    <label for="contrasena">Contraseña:</label>
    <input type="text" name="contrasena"><br>
    <input type="submit" value="Loguearse">
</form>



<?php include('../templates/footer.html'); ?>