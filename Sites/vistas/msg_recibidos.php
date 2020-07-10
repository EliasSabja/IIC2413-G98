<?php
    session_start();
    include('../templates/header.html');
?>
<?php
    $id = $_SESSION["id"];
    $response = file_get_contents("http://go-art.herokuapp.com/messages/$id");
    $response = json_decode($response);
    $response = new SimpleXMLElement($response);
    echo $response;
?>


<?php include('../templates/footer.html'); ?>