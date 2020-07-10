<?php
    session_start();
    include('../templates/header.html');
?>
<?php
    $id = $_SESSION["id"];
    $response = file_get_contents("http://go-art.herokuapp.com/messages");
    $resp = substr($response, 1, -2);
    echo $resp;
    $respuestas = explode(",", $resp);
    $resp = json_decode($resp[0]);
    echo $resp->{'message'};
    #$msgs = array();
    #foreach($response as $resp){
    #    $resp = json_decode($resp);
    #    echo $resp->{'message'};
    #    $msgs
    #}
?>


<?php include('../templates/footer.html'); ?>