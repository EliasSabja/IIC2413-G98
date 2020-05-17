<?php
    require("../../assets/conexion.php");
    $query_c = "SELECT correo FROM usuarios;";
    $result_c = $db9 -> prepare($query_c);
    $result_c -> execute();
    $correos = $result_c -> fetchAll();
    $credenciales =  array(trim($_POST["username"]), trim($_POST["nombre"]), trim($_POST["correo"]), trim($_POST["direccion"]), trim($_POST["contrasena"]));
    $usado = false;
    foreach ($correos as $tupla){
        if (trim($_POST["correo"]) == trim($tupla[0])){
            $usado = true;
        }
    }
    if (($usado) or ($_POST["contrasena"] == null) or ($_POST["correo"] == null)) {
        header("Location: vista_signin.php");
        die();
    }
    else {
        $query_i = "INSERT INTO usuarios VALUES(default, '$credenciales[0]', '$credenciales[1]', '$credenciales[2]', '$credenciales[3]', true, '$credenciales[4]');";
        $result_i = $db9 -> prepare($query_i);
        $result_i -> execute();
        #$foo = $result_i -> fetchAll();
        session_start();
        $_SESSION["user"] = $credenciales[2];
        header("Location: ../../index.php");
        die();
    }
?>