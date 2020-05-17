<?php
    require("../../assets/conexion.php");
    $query = "SELECT correo, contrasena, nombre, logueable FROM usuarios;";
    $result = $db9 -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    $credenciales =  array($_POST["correo"], $_POST["contrasena"]);
    $validado = false;
    # TESTEAR LOGUEABLE
    foreach ($data as $tupla){
        if ((trim($_POST["correo"]) == trim($tupla[0])) and ($_POST["contrasena"] == $tupla[1]) and ($tupla[3] == true)){
            $nombre = $tupla[2];
            $validado = true;
        }
    }
    if ($validado) {
        session_start();
        $_SESSION["nombre"] = $nombre;
        $_SESSION["correo"] = $_POST["correo"];
        header("Location: ../../index.php");
        die();
    }
    else {
        header("Location: vista_login.php");
        die();
    }
?>