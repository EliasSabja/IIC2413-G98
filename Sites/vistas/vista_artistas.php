<?php include('../templates/header.html'); ?>

<?php
    require("../assets/conexion.php");
    $query = "SELECT Artistas.nombre FROM Artistas;";
    $result = $db8 -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll();
?>
<div class="content-box">
    <section class="section section-destination">
        <div>
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
            <hr />
        </div>
    </section>
</div>
<?php include('../templates/footer.html'); ?>