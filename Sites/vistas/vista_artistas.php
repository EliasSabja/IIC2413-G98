<?php include('../templates/header.html'); ?>

<?php
    require("../assets/conexion.php");
    $query = "SELECT DISTINCT anombre FROM artistas;";
    $result = $db -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h2 class="title">Explora los artistas registrados</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Nombre artista</th>
                <th>Ver detalles</th>
            </tr>
            
            </table>
            </article>
            <hr />
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>