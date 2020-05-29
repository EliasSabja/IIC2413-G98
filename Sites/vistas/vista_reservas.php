<?php session_start();
include('../templates/header.html'); ?>

<?php
    require("../assets/conexion.php");
    $id = $_SESSION["id"];
    $query = "SELECT H.nombre, H.direccion, R.f_in, R.f_out FROM RUH, Reservas AS R, Hoteles AS H WHERE :id = RUH.uid AND R.rid = RUH.rid AND H.hid = RUH.hid;";
    $result = $db9 -> prepare($query);
    $result -> execute([ 'id' => $id ]);
    $data = $result -> fetchAll();
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container" style="margin-top:100px;margin-bottom:5px;">
            <h1 class="title">Reservas realizadas por <?php echo $_SESSION["nombre"]?></h1>
        </div>
    </div>
    <div class="container">

        <!-- Tabla -->
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Fecha ingreso</th>
                <th>Fecha egreso</th>
            </tr>
            <?php
                foreach ($data as $p) {
                    echo "<tr> <td>$p[0]</td> <td>$p[1]</td> <td>$p[2]</td> <td>$p[3]</td></tr>";
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
                <a href="vista_perfil.php"class="btn btn-special no-icon" style="margin:5px 20px;border-radius: 5px; width: 146px;">Atras</a>
            </div>

            <!-- Spacer -->
            <div class = "col-md-6 " style="texgitt-align: center;padding:20px;"></div>

        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>