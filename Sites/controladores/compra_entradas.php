<?php session_start();
    $uid = $_SESSION["id"];
    $lid = $_GET["lid"]; 
    
    header("Location: ../vistas/vista_por_lugar.php?lid=$lid");
    die();

    require("../assets/conexion.php");

    $query_entrada = "INSERT INTO entradas VALUES(default, CURRENT_DATE) RETURNING eid;";
    $result_entrada = $db8 -> prepare($query_entrada);
    $result_entrada -> execute();
    $data_entrada = $result_entrada -> fetchAll();

    foreach ($data_entrada as $entrada){
        $eid = $entrada[0];
    }

    $query_eum = "INSERT INTO eum VALUES(:eid, :userid, :lid);";
    $result_eum = $db9 -> prepare($query_eum);
    $result_eum -> execute(["eid" -> $eid, "userid" -> $uid, "lid" -> $lid]);
    $data_eum = $result_eum -> fetchAll();
?>
