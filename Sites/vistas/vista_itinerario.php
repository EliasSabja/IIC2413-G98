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

    $query_ciudades = "SELECT DISTINCT cid, ciudad FROM ciudades;";
    $result_ciudades = $db9 -> prepare($query_ciudades);
    $result_ciudades -> execute();
    $data_ciudades = $result_ciudades -> fetchAll();
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Revisa las posibilidades que te entrega GoArt</h1>
        </div>
    </div>
    <div class="container">
        <h2 style="text-align:center;">Marca los artistas que deseas encontrar en tu viaje</h2>
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
                    echo "<tr> <td>$p[1]</td><td><input type='checkbox' name='artistas_aid[]' value='$p[0]'</td></tr>";
                }
            ?> 
            </table>
        </div><br><br>
        <h2 style="text-align:center;">Escoge la ciudad en que comenzará tu viaje</h2>
        <div class="row" style="text-align:center;">
            <select name="ciudad">
                <?php
                    foreach($data_ciudades as $ciudad){
                        echo "<option value='$ciudad[0]'>$ciudad[1]</option>";
                    }
                ?>
            </select>
        </div><br><br>
        <h2 style="text-align:center;">Escoge la fecha en que deseas viajar</h2>
        <div class="input-line" style="text-align:center;">
                            <input id="date" type="date" name="date" min=
                                <?php
                                    echo date('Y-m-d');
                                ?>
                            >
        </div><br><br>
        <div class = "col-md-24 " style="text-align: center;padding:20px;">
            <input type="submit" value="Revisar itinerarios" class="btn btn-special no-icon size-2x" style="margin:0 auto;"/>
        </div>
        </form>

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
    </div>
</section>

<?php include('../templates/footer.html'); ?>