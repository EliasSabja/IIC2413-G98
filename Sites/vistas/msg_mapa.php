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
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-12">
            <div id="mapid" style="height:500px;width:100%;"></div>
        </div>
        <div class="col-md-6"></div>
    </div>

</section>

<footer class="main-footer">
    <div class="container">
       <div class="row">

          <div class="col-md-5">
             <div class="widget widget_links">
                <h5 class="widget-title">Servicios</h5>
                <ul>
                   <li><a href="vista_artistas.php">Artistas</a></li>
                   <li><a href="vista_obras.php">Obras</a></li>
                   <li><a href="vista_lugares.php">Lugares de interes</a></li>
                </ul>
             </div>
          </div>

          <div class="col-md-5">
             <div class="widget widget_links">
                <h5 class="widget-title">Viajes y estadía</h5>
                   <ul>
                      <li><a href="vista_comprar_ticket.php">Comprar ticket de viaje</a></li>
                      <li><a href="vista_hacer_reserva.php">Hacer reserva de hotel</a></li>
                      <li><a href="vista_itinerario.php">Crear itinerario</a></li>
                   </ul>
             </div>
          </div>

          
          <div class="col-md-5">
             <div class="widget widget_links">
                <h5 class="widget-title">Autores</h5>
                <ul>
                   <li><a href="https://www.instagram.com/diegoemilio01/?hl=es-la" target="_blank">Diego Bustamante</a></li>
                   <li><a href="https://www.instagram.com/luckbox314/?hl=es-la" target="_blank">Lucas Muñoz</a></li>
                   <li><a href="https://www.instagram.com/eli_sabja/?hl=es-la" target="_blank">Elias Sabja</a></li>
                </ul>
             </div>
          </div>
          
       </div>
    </div>
 </footer>

 <!-- Scripts -->
 <script src="../js/calendar.js"></script>
 <script src="../js/jquery.js"></script>
 <script src="../js/functions.js"></script>

</body>

<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
crossorigin=""></script>
<script>
    
    var mymap = L.map('mapid');
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiZWxpYXMyMTA1c2IiLCJhIjoiY2tjaWhteHVqMHFidzJxbzBwMmE0MGUwbCJ9.9K8F9xdOATN10tNQjADDTQ'}).addTo(mymap);
    <?php 
        foreach ($msgs as $msg){
            if($fecha_i < $msg->{"date"} && $fecha_f > $msg->{"date"}){
                echo "L.marker([" . strval($msg->{"lat"}) . "," . strval($msg->{"long"}) . "]).addTo(mymap).bindPopup('<b>" . strval($msg->{"date"}) . "</b><br>" . strval($msg->{"message"}) . "');";
                $view_lat = $msg->{"lat"};
                $view_long = $msg->{"long"};
            }
        }
    ?>
    mymap.setView([<?php echo $view_lat;?>, <?php echo $view_long; ?>], 13);
</script>
</html>