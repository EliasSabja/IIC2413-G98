<?php include('../templates/header.html'); ?>

<?php
    $current_aid = $_GET['id'];

    require("../assets/conexion.php");
    $query = "SELECT DISTINCT * FROM artistas WHERE artistas.aid=$current_aid;";
    $result = $db8 -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <?php echo "<h1 class='title'> $dataCollected[0] </h1>"?>
            <h3>Datos del artista</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Nombre artista</th>
                <th>Fecha de nacimiento</th>
                <th>Descripción</th>
            </tr>
            <?php
                foreach ($dataCollected as $p) {
                    echo "<tr> <td>$p[1]</td><td>$p[2]</td><td>$p[3]</td></tr>";
                }
            ?>
            </table>
            </article>
            <hr />
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>