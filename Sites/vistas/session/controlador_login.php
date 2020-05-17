<?php
    require("../../assets/conexion.php");
    $query = "SELECT nombre, contrasena FROM usuarios;";
    $result = $db9 -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    $credenciales =  array($_POST["correo"], $_POST["contrasena"]);
    echo "<!DOCTYPE html><html> <body> <h1> $credenciales </h1></body> </html>"
    if (in_array($credenciales, $data)) {
        session_start();
        $_SESSION["user"] = $credenciales[0];
        header("Location: ../../index.php");
        die();
    }
    else {
        header("Location: vista_login.php");
        die();
    }
?>