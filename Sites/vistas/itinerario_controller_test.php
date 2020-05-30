<?php $aids = $_POST['artistas_aid'];
    $cid = $_POST['ciudad'];
    $fecha = $_POST['date'];
    echo "$aids";

    for($i=0; $i < count($aids); $i++){
        echo "Selected " . $aids[$i] . "<br/>";
    }
    echo "<br>";
    foreach ($aids as $p) {
        echo "$p<br>";
    }
    echo "Ciudad ID:$cid<br>";
    echo "Fecha: $fecha";
?>