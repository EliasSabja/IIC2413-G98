<?php
    require("../../assets/conexion.php");
    $query = "SELECT correo, contrasena FROM usuarios;";
    $result = $db9 -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    $credenciales =  array($_POST["correo"], $_POST["contrasena"]);
    $valores = array(gettype($credenciales[1]), gettype($data[0][1]));
    echo "<!DOCTYPE html> <body> <h1> $valores[0], $valores[1] </h1>";
    #foreach($data as $p){
    #    echo "$p[0], $p[1]-";
    #}
    $validado = false;
    foreach ($data as $tupla){
        if (array($_POST["correo"], $_POST["contrasena"]) == array($tupla[0], $tupla[1])){
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