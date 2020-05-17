<?php
    require("../../assets/conexion.php");
    $query = "SELECT correo, contrasena FROM usuarios;";
    $result = $db9 -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    $credenciales =  array(trim($_POST["correo"]), $_POST["contrasena"]);
    #$valores = array(gettype($credenciales[1]), gettype($data[0][1]));
    echo "<!DOCTYPE html> <body>";
    $validado = false;
    foreach ($data as $tupla){
        if ((trim($_POST["correo"]) == trim($tupla[0])) and ($_POST["contrasena"] == $tupla[1])){
            echo 1;
            $validado = true;
        }
    }
    echo $validado ? 'true':'false';
    echo "</body></html>" ;
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