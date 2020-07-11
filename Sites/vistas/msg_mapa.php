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
    
    <div id="mapid" style="height:180px;width:680px;"></div>

</section>
<?php include('../templates/footer_mapa.html'); ?>