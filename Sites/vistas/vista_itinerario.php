<?php include('../templates/header.html'); ?>

<?php 
    #Artistas con checkboxes y que retorne aid
    #Fecha inicio y termino del viaje
    #Ciudad de origen

    require("../assets/conexion.php");
    $query = "SELECT DISTINCT aid, anombre FROM artistas;";
    $result = $db8 -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll();
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Revisa las posibilidades que te entrega GoArt</h1>
        </div>
    </div>
    <div class="container">
        <h2>Marca los artistas que deseas encontrar en tu viaje</h2>
        <form action="itinerario_controller_test.php" method="post">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Nombre artista</th>
                <th></th>
            </tr>
            <?php
                foreach ($dataCollected as $p) {
                    echo "<tr> <td>$p[1]</td><td><input type='checkbox' name='artistas_aid[]' value=$p[0]</td></tr>";
                }
            ?> 
            </table>
            <!-- Go back -->
            <div class="row" style="padding:20px;">
                <!-- Spacer -->
                <div class = "col-md-6 col " style="text-align: center;padding:20px;"></div>

                    <!-- Button -->
                    <div class = "col-md-12 " style="text-align: center;padding:20px;">
                        <a onclick="window.history.back()" class="btn btn-special no-icon" style="margin:5px 20px;border-radius: 5px; width: 146px;">Atras</a>
                    </div>

                <!-- Spacer -->
                <div class = "col-md-6 " style="text-align: center;padding:20px;"></div>

            </div>
            </article>
            <hr />
        <input type="submit"/>
        </div>
        </form>
    </div>
</section>

<?php include('../templates/footer.html'); ?>