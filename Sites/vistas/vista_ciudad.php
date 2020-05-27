<?php include('../templates/header.html'); ?>

<?php
    $cid = $_GET['cid'];

    require("../assets/conexion.php");
    $query = "SELECT hoteles.nombre, hoteles.direccion, hoteles.telefono, hoteles.precio,   hoteles.hid FROM hec, hoteles WHERE hec.cid = :cid AND hec.hid = hoteles.hid; "; 

    $result = $db9 -> prepare($query);
    $result -> execute(['cid' => $cid]);
    $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo

?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h2 class="title">Elige el hotel en el que quieras reservar</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Nombre</th><th>Dirección</th><th>Telefono</th><th>Precio</th><th></th>
            </tr>
            <?php
                foreach ($dataCollected as $p) {
                    echo "<tr>
                    <td>$p[0]</td>
                    <td>$p[1]</td>
                    <td>$p[2]</td>
                    <td>$p[3]</td>
                    <td><a href='vista_hotel.php?hid=$p[4]' class='btn btn-special no-icon' style='margin:5px 20px;border-radius: 5px;'>Reservar</a></td>
                    </tr>";
                }
            ?> 
            </table>
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
                <div class = "col-md-6 " style="texgitt-align: center;padding:20px;"></div>

            </div>
            <hr />
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>