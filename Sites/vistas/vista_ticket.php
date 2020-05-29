<?php include('../templates/header.html'); ?>

<?php
    require("../assets/conexion.php");

    $vid = $_GET["id"];
    $date = $_GET["date"];

    $query = "SELECT T.asiento FROM Tickets AS T, TUV WHERE :vid = TUV.vid AND TUV.tid = T.tid AND :date = T.f_viaje;";
    $result = $db9 -> prepare($query);
    $result -> bindParam(':vid', $vid, PDO::PARAM_STR);
    $result -> bindParam(':date', $date, PDO::PARAM_STR);
    $result -> execute();
    $data = $result -> fetchAll();

    $query_max = "SELECT capacidad FROM Viajes WHERE vid = :vid;";
    $result_max = $db9 -> prepare($query_max);
    $result_max -> bindParam(':vid', $vid, PDO::PARAM_STR);
    $result_max -> execute();
    $data_max = $result_max -> fetchAll();

    $capacidad = $data_max[0][0];

    $asientos = range(1,$capacidad);


    foreach ($data as $asiento){
        echo $asiento;
        if (($key = array_search(intval($asiento[0]), $asientos)) !== false) {
            unset($asientos[$key]);
        }
    }

?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Asientos</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-8" style="text-align:center;">
                    <?php
                        if(!$asientos){
                            echo "<h2>No quedan asientos disponibles</h2>";
                        }
                        else{
                            echo "<h2>Elige un número de asiento</h2>";
                        }
                    ?>

                    <form action="vista_ticket_comprado.php" method="post">
                        <?php
                            echo "
                            <input type='hidden' name='vid' id='vid' value='$vid'>
                            <input type='hidden' name='date' id='date' value='$date'>
                            "
                        ?>
                        <select name="asiento" id="asiento">
                            <?php
                            foreach($asientos as $a){
                                echo "<option value='$a'>$a</option>";
                            }
                            ?>
                        </select>
                        <input <?php if(!$asientos){echo "disabled";}?> type="submit" value="Comprar" class="btn btn-special no-icon size-2x" style="position: static; border-radius: 5px;">
                    </form>
                </div>
                <div class="col-md-8"></div>
            </div>


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
    </div>
</section>

<?php include('../templates/footer.html'); ?>