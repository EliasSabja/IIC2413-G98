<?php 
    session_start();
    include('../templates/header.html');
?>

<?php
    require("../assets/conexion.php");
    $query = "SELECT DISTINCT V.vid, V.precio, V.medio, V.h_salida, V.duracion FROM Viajes AS V, VOD WHERE V.vid = VOD.vid AND :origen= VOD.o_cid AND :destino = VOD.d_cid;";
    $result = $db9 -> prepare($query);
    $result -> bindParam(':origen', $_POST["ciudad_origen"], PDO::PARAM_STR);
    $result -> bindParam(':destino', $_POST["ciudad_destino"], PDO::PARAM_STR);
    $result -> execute();
    $data = $result -> fetchAll();
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Viajes disponibles</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Precio</th><th>Medio</th><th>Hora de salida</th><th>Duración</th><th></th>
            </tr>
            <?php
                foreach ($data as $p) {
                    echo "<tr>
                    <td>$p[1]</td>
                    <td>$p[2]</td>
                    <td>$p[3]</td>
                    <td>$p[4]</td>
                    <td><a href='vista_ticket.php?id=$p[0]&date=$date' class='btn btn-special no-icon' style='margin:5px 20px;border-radius: 5px;'>Comprar</a></td>
                    </tr>";
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
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>