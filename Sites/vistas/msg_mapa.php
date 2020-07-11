<?php
    session_start();
    include('../templates/header.html');
?>
<?php
    $id = $_SESSION["id"];
    $fecha_i = $_POST["date_i"];
    $fecha_f = $_POST["date_f"];
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