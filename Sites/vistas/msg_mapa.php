<?php
    session_start();
    include('../templates/header.html');
?>
<?php
    $id = $_SESSION["id"];
    $fecha_i = $_POST["date_i"];
    $fecha_f = $_POST["date_f"];
    $response = file_get_contents("http://go-art.herokuapp.com/messages?id1=$id");
    $response = str_replace("},{", "}~~{", $response);
    $response = substr($response, 1, -2);
    $respuestas = explode("~~", $response);
    $msgs = array();
    foreach($respuestas as $resp){
        $resp = json_decode($resp);
        array_push($msgs, $resp);
    }
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Ubicación de mensajes entre <?php echo $fecha_i ?> y <?php echo $fecha_f ?></h1>
        </div>
    </div>
    
    <div class="mapid">
        <script>
            var mymap = L.map('mapid').setView([51.505, -0.09], 13);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZWxpYXMyMTA1c2IiLCJhIjoiY2p1aHQ0bG5qMTNmeDQ0dTlrYmVwczIxeiJ9.nQgtI9N87X-eoI5ROjoh4A'}).addTo(mymap);
            var marker = L.marker([51.5, -0.09]).addTo(mymap);
        </script>
    </div>
</section>
<?php include('../templates/footer.html'); ?>