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
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Nombre artista</th>
                <th></th>
            </tr>
            <?php
                foreach ($dataCollected as $p) {
                    echo "<tr> <td>$p[0]</td> <td> <a href='vista_por_artista.php?id=$p[1]'>Ingresar a la página del artista</a></td> </tr>";
                }
            ?> 
            </table>
            </article>
            <hr />
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>