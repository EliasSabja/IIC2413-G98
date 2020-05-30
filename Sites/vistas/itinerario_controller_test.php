<?php $aids = $_POST['artistas_aid'];

    echo "$aids";

    for($i=0; $i < count($aids); $i++){
        echo "Selected " . $aids[$i] . "<br/>";
    }
?>