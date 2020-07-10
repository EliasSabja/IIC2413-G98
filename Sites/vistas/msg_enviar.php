<?php include('../templates/header.html'); ?>

<?php
    $id = $_SESSION["id"];
    $response = file_get_contents('http://go-art.herokuapp.com/');
    $response = json_decode($response);
    $response = new SimpleXMLElement($response);
?>



<?php include('../templates/footer.html'); ?>