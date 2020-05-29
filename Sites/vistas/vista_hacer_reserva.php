<?php include('../templates/header.html'); ?>

<?php
    require("../assets/conexion.php");
    $query = "SELECT pais FROM paises;";
    $result = $db9 -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll();
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1 class="title">Elige el país donde se encuentre el hotel en el que quieras reservar</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Pais</th>
            </tr>
            <?php
                foreach ($dataCollected as $p) {
                    echo "<tr> <td><a href='vista_pais.php?pais=$p[0]'>$p[0]</a></td></tr>";
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