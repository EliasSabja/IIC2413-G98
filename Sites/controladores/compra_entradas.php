<?php session_start();
    $uid = $_SESSION["id"];
    $lid = $_GET["lid"]; 

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
    $result_eum -> bindParam(':eid', $eid, PDO::PARAM_INT);
    $result_eum -> bindParam(':userid', $uid, PDO::PARAM_INT);
    $result_eum -> bindParam(':lid', $lid, PDO::PARAM_INT);
    $result_eum -> execute();
    $data_eum = $result_eum -> fetchAll();

    header("Location: ../vistas/vista_por_lugar.php?id=$lid");
    die();
?>
