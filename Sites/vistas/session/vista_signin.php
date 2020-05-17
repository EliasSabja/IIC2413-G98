<?php include('../templates/header.html'); ?>



<form action="controlador_login.php" method="post">
    <input type="text" name=""><br>
    <input type="submit" value="Loguearse">
    <label for="correo">Correo:</label>
    <input type="text" name="correo"><br>
    <label for="contrasena">Contraseña:</label>
    <input type="text" name="contrasena"><br>
    <input type="submit" value="Loguearse">
</form>



<?php include('../templates/footer.html'); ?>