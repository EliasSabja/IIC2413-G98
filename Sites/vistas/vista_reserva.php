<?php
    session_start();
    $hid = $_GET['hid'];
    $f_i = $_POST["in"];
    $f_o = $_POST["out"];
    $f_in = str_replace('-', '/', $f_i);  
    $f_out = str_replace('-', '/', $f_o);  

    require("../assets/conexion.php");
    $query_reserva = "INSERT INTO reservas VALUES(default, :fin, :fout) RETURNING rid;";
    $result_reserva = $db9 -> prepare($query_reserva);
    $result_reserva -> bindParam(':fin', $f_in, PDO::PARAM_STR);
    $result_reserva -> bindParam(':fout', $f_out, PDO::PARAM_STR);
    $result_reserva -> execute();
    $data_reserva = $result_reserva -> fetchAll();

    $query_ruh = "INSERT INTO ruh VALUES(:rid, :uid, :hid);";
    $result_ruh = $db9 -> prepare($query_ruh);
    $result_ruh -> bindParam(':rid', $data_reserva[0][0], PDO::PARAM_INT);
    $result_ruh -> bindParam(':uid', $_SESSION["id"], PDO::PARAM_INT);
    $result_ruh -> bindParam(':hid', $hid, PDO::PARAM_INT);
    $result_ruh -> execute();
    $data_ruh = $result_ruh -> fetchAll();

    $query_h = "SELECT H.nombre, H.precio FROM hoteles AS H WHERE :hid = H.hid"; 
    $result_h = $db9 -> prepare($query_h);
    $result_h -> execute(['hid' => $hid]);
    $data_h = $result_h -> fetchAll();
?>

<?php include('../templates/header.html'); ?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Reserva realizada</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <h3>Datos de la reserva</h3>
            <table class="custom">
            <tr>
                <th>Nombre del usuario</th><th>Nombre hotel</th><th>Precio</th><th>Check-in</th><th>Check-out</th>
            </tr>
            <?php
                $nombre = $_SESSION['nombre'];
                $nombre_hotel = $data_h[0][0];
                $precio = $data_h[0][1];
                echo "<tr>
                <td>$nombre</td>
                <td>$nombre_hotel</td>
                <td>$precio</td>
                <td>$f_in</td>
                <td>$f_out</td>
                </tr>";
            ?> 
            </table>
            <br>
            <div style="text-align: center;">
                <a href="vista_reservas.php" class="btn btn-special no-icon" style="margin:0;border-radius: 5px;">Reservas</a>
            </div>
            </article>
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
            <hr />
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>