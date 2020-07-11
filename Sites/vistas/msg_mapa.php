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

    echo 'mensajes', $msgs;

    foreach ($msgs as $m) {
        if (
            strtotime($m->{'date'}) > strtotime($fecha_i) &
            strtotime($m->{'date'}) < strtotime($fecha_f)
        ){
            $f = $m->{'date'};
            $la = $m->{'lat'};
            $lo = $m->{'long'};
            $me = $m->{'message'};
            $mid = $m->{'mid'};
            $r = $m->{'receptant'};
            $s = $m->{'sender'};
            echo "<tr><td>$f</td><td>$la</td><td>$lo</td><td>$me</td><td>$mid</td><td>$r</td><td>$s</td></tr>";
        }
        

    }

    #echo "<tr><td>$fecha_i</td><td>$fecha_f</td></tr>";
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
<?php include('../templates/footer_mapa.html'); ?>