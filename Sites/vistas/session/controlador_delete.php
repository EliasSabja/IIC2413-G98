<?php
    session_start();
    require("../../assets/conexion.php");
    $correo = $_SESSION["correo"];
    $query_c = "UPDATE usuarios SET logueable=false WHERE correo = '$correo';";
    $result_c = $db9 -> prepare($query_c);
    $result_c -> execute();
    $datos = $result_c -> fetchAll();
    session_destroy();

    header("Location: ../../index.php");
    die();
?>