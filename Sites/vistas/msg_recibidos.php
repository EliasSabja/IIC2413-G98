<?php
    session_start();
    include('../templates/header.html');
?>
<?php
    $id = $_SESSION["id"];
    $response = file_get_contents("http://go-art.herokuapp.com/messages");
    $response = str_replace("},{", "}~~{", $response);
    $response = substr($response, 1, -2);
    $respuestas = explode("~~", $response);
    echo $respuestas;
    $msgs = array();
    foreach($respuestas as $resp){
        $resp = json_decode($resp);
        echo $resp->{'message'};
        array_push($msgs, $resp);
    }
?>


<?php include('../templates/footer.html'); ?>