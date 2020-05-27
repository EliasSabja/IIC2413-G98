<?php
    require("../../assets/conexion.php");
    $query_c = "SELECT correo, username, FROM usuarios;";
    $result_c = $db9 -> prepare($query_c);
    $result_c -> execute();
    $datos = $result_c -> fetchAll();

    $credenciales =  array(trim($_POST["username"]), trim($_POST["nombre"]), trim($_POST["correo"]), trim($_POST["direccion"]), trim($_POST["contrasena"]));
    $usado = false;
    foreach ($datos as $tupla){
        if (trim($_POST["correo"]) == trim($tupla[0])){
            $usado = true;
        }
        if (trim($_POST["username"]) == trim($tupla[1])){
            $usado = true;
        }
    }
    if (($usado) or ($_POST["contrasena"] == null) or ($_POST["correo"] == null)) {
        header("Location: vista_signup.php");
        die();
    }
    else {
        $query_i = "INSERT INTO usuarios VALUES(default, '$credenciales[0]', '$credenciales[1]', '$credenciales[2]', '$credenciales[3]', true, '$credenciales[4]');";
        $result_i = $db9 -> prepare($query_i);
        $result_i -> execute();
        
        $query_uid = "SELECT uid FROM usuarios WHERE correo = $credenciales[2];";
        $result_uid = $db9 -> prepare($query_uid);
        $result_uid -> execute();
        $uid = $result_uid -> fetchAll();
        session_start();
        $_SESSION["correo"] = $credenciales[2];
        $_SESSION["nombre"] = $credenciales[1];

        #Testear
        $_SESSION["id"] = $uid[0][0]; 

        header("Location: ../../index.php");
        die();
    }
?>