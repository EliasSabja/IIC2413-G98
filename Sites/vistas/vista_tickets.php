<?php session_start();
include('../templates/header.html'); ?>

<?php
    require("../assets/conexion.php");
    $id = $_SESSION["id"];
    $query = "SELECT T.asiento, T.f_viaje AS fecha_viaje, T.f_compra AS fecha_compra, V.medio, C1.ciudad AS origen, C2.ciudad AS destino FROM TUV, Tickets AS T, Viajes AS V, VOD, Ciudades AS C1, Ciudades AS C2 WHERE $id = TUV.uid AND TUV.tid = T.tid AND TUV.vid = V.vid AND V.vid = VOD.vid AND VOD.o_cid = C1.cid AND VOD.d_cid = C2.cid;";
    $result = $db9 -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container" style="margin-top:100px;margin-bottom:5px;">
            <h2 class="title">Tickets de <?php echo $_SESSION["nombre"]?></h2>
        </div>
    </div>
    <div class="container">

        <!-- Tabla -->
        <div class="row">
            <article>
            <table class="custom">
            <tr>

                <th>Fecha de viaje</th>
                <th>Fecha de compra</th>

                <th>Medio</th>
                
                <th>Numero de asiento</th>

                <th>Ciudad de origen</th>
                <th>Ciudad de destino</th>

            </tr>
            <?php
                foreach ($data as $p) {
                    echo "<tr> 
                        <td>$p[1]</td>
                        <td>$p[2]</td>
                        <td>$p[3]</td>
                        <td>$p[0]</td>
                        <td>$p[4]</td>
                        <td>$p[5]</td>
                    </tr>";
                }
            ?> 
            </table>
            </article>
            <hr />
        </div>
         
        
        <!-- Go back -->
        <div class="row" style="padding:20px;">
            <!-- Spacer -->
            <div class = "col-md-6 col " style="text-align: center;padding:20px;"></div>

            <!-- Button -->
            <div class = "col-md-12 " style="text-align: center;padding:20px;">
                <a href="../index.php"class="btn btn-special no-icon" style="margin:5px 20px;border-radius: 5px; width: 146px;">Atras</a>
            </div>

            <!-- Spacer -->
            <div class = "col-md-6 " style="texgitt-align: center;padding:20px;"></div>

        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>