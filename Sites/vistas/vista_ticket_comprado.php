<?php
    session_start();
    $vid = $_POST['vid'];
    $date = $_POST["date"];
    $asiento = $_POST["asiento"];
    $date = str_replace('-', '/', $date);
    $id = $_SESSION["id"];

    require("../assets/conexion.php");
    $query_ticket = "INSERT INTO tickets VALUES(default, :asiento, CURRENT_DATE, :date) RETURNING tid;";
    $result_ticket = $db9 -> prepare($query_ticket);
    $result_ticket -> bindParam(':asiento', $asiento, PDO::PARAM_STR);
    $result_ticket -> bindParam(':date', $date, PDO::PARAM_STR);
    $result_ticket -> execute();
    $data_ticket = $result_ticket -> fetchAll();
    $tid = $data_ticket[0][0];

    $query_tuv = "INSERT INTO tuv VALUES(:tid, :uid, :vid);";
    $result_tuv = $db9 -> prepare($query_tuv);
    $result_tuv -> bindParam(':tid', $tid, PDO::PARAM_INT);
    $result_tuv -> bindParam(':uid', $id, PDO::PARAM_INT);
    $result_tuv -> bindParam(':vid', $vid, PDO::PARAM_INT);
    $result_tuv -> execute();
    $data_tuv = $result_tuv -> fetchAll();

    $query_t = "SELECT V.h_salida, T.f_viaje, V.medio, C1.ciudad, C2.ciudad, V.precio FROM TUV, Tickets AS T, Viajes AS V, VOD, Ciudades AS C1, Ciudades AS C2 WHERE $id = TUV.uid AND TUV.tid = T.tid AND TUV.vid = V.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD.d_cid = C2.cid AND T.tid = $tid;";
    $result_t = $db9 -> prepare($query_t);
    $result_t -> execute();
    $data_t = $result_t -> fetchAll();
?>

<?php include('../templates/header.html'); ?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Ticket comprado</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <h3>Datos del ticket</h3>
            <table class="custom">
            <tr>
                <th>Nombre del usuario</th><th>Hora de salida</th><th>Fecha de viaje</th><th>Medio</th><th>Número de asiento</th><th>Ciudad de origen</th><th>Ciudad de destino</th><th>Precio</th>
            </tr>
            <?php
                $nombre = $_SESSION['nombre'];
                $h_salida = $data_t[0][0];
                $f_viaje = $data_t[0][1];
                $medio = $data_t[0][2];
                $n_asiento = $asiento;
                $ciudad_o = $data_t[0][3];
                $ciudad_d = $data_t[0][4];
                $precio = $data_t[0][5];
                echo "<tr>

                <td>$nombre</td>
                <td>$h_salida</td>
                <td>$f_viaje</td>
                <td>$medio</td>
                <td>$n_asiento</td>
                <td>$ciudad_o</td>
                <td>$ciudad_d</td>
                <td>$precio</td>

                </tr>";
            ?> 
            </table>
            <br>
            <div style="text-align: center;">
                <a href="vista_tickets.php" class="btn btn-special no-icon" style="margin:0;border-radius: 5px;">Tickets</a>
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