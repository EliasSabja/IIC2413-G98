<?php session_start(); 
    header("Location: ../vistas/vista_por_lugar?lid=$_GET["lid"]");
    die();?>

<?php
    require("../assets/conexion.php");
    $uid = $_SESSION["id"];
    $lid = $_GET["lid"];

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
