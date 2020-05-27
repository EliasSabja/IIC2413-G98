<?php include('../templates/header.html'); ?>

<?php 
    require("../assets/conexion.php");
    $query = "SELECT lugares.lid, lugares.lnombre
    FROM lugares;";
    $result = $db8 -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll();
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h2 class="title">Explora los lugares registrados</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Nombre lugar</th>
            </tr>
            <?php
                foreach ($dataCollected as $p) {
                    echo "<tr> <td><a href='vista_por_lugar.php?id=$p[1]'>$p[0]</a></td></tr>";
                }
            ?> 
            </table>
            </article>
            <hr />
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>