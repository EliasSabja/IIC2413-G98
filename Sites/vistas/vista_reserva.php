<?php
    session_start();
    $hid = $_GET['hid'];
    $f_i = $_POST["in"];
    $f_o = $_POST["out"];
    $f_in = str_replace('-', '/', $f_i);  
    $f_out = str_replace('-', '/', $f_o);  

    require("../assets/conexion.php");
    $query_reserva = "INSERT INTO reservas VALUES(default, :f_in, :f_out) RETURNING rid;";
    $result_reserva = $db9 -> prepare($query_insert);
    $result_reserva -> execute(['f_in' => $f_in, 'f_out' => $f_out]);
    $data_reserva = $result_reserva -> fetchAll();

    $query_ruh = "INSERT INTO ruh VALUES(:rid, :uid, :hid);";
    $result_ruh = $db9 -> prepare($query_ruh);
    $result_ruh -> execute(['rid' => $data_reserva[0][0], 'uid' => $_SESSION["id"], 'hid' => $hid]);
    $data_ruh = $result_ruh -> fetchAll();

    $query_h = "SELECT H.nombre, H.precio FROM hoteles AS H WHERE :hid = H.hid"; 
    $result_h = $db9 -> prepare($query_h);
    $result_h -> execute(['hid' => $hid]);
    $data_h = $result -> fetchAll();
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
                echo "<tr>
                <td>$nombre</td>
                <td>$data_h[0]</td>
                <td>$data_h[1]</td>
                <td>$f_in</td>
                <td>$f_out</td>
                </tr>";
            ?> 
            </table>
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