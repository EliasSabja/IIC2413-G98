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
    <div class="container" style="margin:50px;">

        <div class="row" style="height:200px;">
            <div class = "col-md-8 " style="text-align: center;" >
                <h1> Entradas <h1>
                <p>Revisa todas tus Entradas a museos</p>
                <a href="#" class="btn no-icon">Go</a>
            </div>
            <div class = "col-md-8 " style="text-align: center;">
                <h1> Reservas</h1>
                <p>Revisa todas tus reservas en hoteles</p>
                <a href="#" class="btn no-icon">Go</a>
            </div>
            <div class = "col-md-8 " style="text-align: center;">
                <h1> Tickets </h1>
                <p>Revisa todos tus tickets para viajes</p>
                <a href="#" class="btn no-icon">Go</a>
            </div>
        </div>

        <div class="row" style="height:60px;">
            <div class = "col-md-12 " style="text-align: center;">
                <a href="../index.php"class="btn no-icon">Atras</a>
            </div>
            <div class = "col-md-12 " style="text-align: center;">
            <a href="#" class="btn no-icon">Log out</a>
            </div>
        </div>

        <div class="row" style="height:200px;">
        <div class = "col-md-24 " style="text-align: center; border-style:groove;">
            <h1>Danger zone</h1>
            <a href="# u sure?" class="btn btn-special no-icon" style="border-radius: 5px;">Borrar Cuenta</a>
            <p> borrar tu cuenta implica que no podrás volver a logearte nunca más.</p>
        </div>
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>