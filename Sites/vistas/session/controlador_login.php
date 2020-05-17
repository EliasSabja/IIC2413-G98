<?php
    require("../../assets/conexion.php");
    $query = "SELECT correo, contrasena FROM usuarios;";
    $result = $db9 -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    $credenciales =  array($_POST["correo"], $_POST["contrasena"]);
    #echo "<!DOCTYPE html> <body> <h1> $data[0], $data[1] </h1>";
    #foreach($data as $p){
    #    echo "$p[0], $p[1]-";
    #}
    #echo "</body></html>" ;
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