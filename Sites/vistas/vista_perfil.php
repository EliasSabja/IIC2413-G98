<?php include('../templates/header.html'); ?>

<?php
    require("../assets/conexion.php");
    $query = "SELECT DISTINCT anombre, aid FROM artistas;";
    $result = $db8 -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h2 class="title">Explora los artistas registrados</h2>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row" style="height:200px;">
            <div class = "col-md-8 border" style="text-align: center;" >
                <h1> Entradas <h1>
            </div>
            <div class = "col-md-8 border" style="text-align: center;">
                <h1> Reservas</h1>
            </div>
            <div class = "col-md-8 border" style="text-align: center;">
                <h1> Tickets </h1>
            </div>
        </div>

        <div class="row" style="height:60px;">
            <div class = "col-md-12 border" style="text-align: center;">
                <h1>Atras</h1>
            </div>
            <div class = "col-md-12 border" style="text-align: center;">
                <h1>Log out</h1>
            </div>
        </div>

        <div class="row" style="height:200px;">
        <div class = "col-md-24 border" style="text-align: center;">
            <h1>Eliminar</h1>
        </div>
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>