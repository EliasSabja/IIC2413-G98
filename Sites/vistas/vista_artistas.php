<?php include('../templates/header.html'); ?>

<?php
    require("../assets/conexion.php");
    $query = "SELECT Artistas.nombre FROM Artistas;";
    $result = $db8 -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll();
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
            <table>
            <tr>
                <th>Nombre artista</th>
                <th>Ver detalles</th>
            </tr>
            <?php
                foreach ($dataCollected as $p) {
                    echo "<tr> <td>$p[0]</td> <td> <a> Ver detalles </a> </td> </tr>";
                }
            ?>
            </table>
            </article>
            <hr />
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>