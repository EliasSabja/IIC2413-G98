<?php
    session_start();
    include('../templates/header.html');
?>
<?php
    $id = $_SESSION["id"];
    $response = file_get_contents("http://go-art.herokuapp.com/messages/$id");
    $resp = substr($response, 1, -2);
    echo $
    $respuestas = explode(",", $pizza);
    $resp = json_decode($resp);
    echo $resp->{'message'};
    #$msgs = array();
    #foreach($response as $resp){
    #    $resp = json_decode($resp);
    #    echo $resp->{'message'};
    #    $msgs
    #}
?>


<?php include('../templates/footer.html'); ?>