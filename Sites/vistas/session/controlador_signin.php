<?php
    require("../assets/conexion.php");
    $query_c = "SELECT correo FROM usuarios;";
    $result_c = $db9 -> prepare($query_c);
    $result_c -> execute();
    $correos = $result_c -> fetchAll();
    $credenciales =  array($_POST["username"], $_POST["nombre"], $_POST["direccion"], $_POST["correo"], $_POST["contrasena"]);
    if (in_array(array($credenciales["correo"]), $correos) or ($_POST["contrasena"] == null) or ($_POST["correo"] == null)) {
        header("Location: vista_signin.php");
        die();
    }
    else {
        $query_i = "INSERT INTO usuarios VALUES(default, $credenciales[0], $credenciales[1], $credenciales[2], $credenciales[3], true, $credenciales[4]);";
        $result_i = $db9 -> prepare($query_c);
        $result_i -> execute();
        $foo = $result_i -> fetchAll();
        session_start();
        $_SESSION["user"] = $credenciales[3];
        header("Location: ../../index.php");
        die();
    }
?>