<?php session_start();
    $uid = $_SESSION["id"];
    $unombre = $_SESSION["nombre"];
    $lid = $_GET["lid"]; 

    require("../assets/conexion.php");
    
    $query_entrada = "INSERT INTO entradas VALUES(default, CURRENT_DATE) RETURNING eid;";
    $result_entrada = $db8 -> prepare($query_entrada);
    $result_entrada -> execute();
    $data_entrada = $result_entrada -> fetchAll();

    foreach ($data_entrada as $entrada){
        $eid = $entrada[0];
    }

    $query_eum = "INSERT INTO eum VALUES(:eid, :userid, :lid);";
    $result_eum = $db8 -> prepare($query_eum);
    $result_eum -> bindParam(':eid', $eid, PDO::PARAM_INT);
    $result_eum -> bindParam(':userid', $uid, PDO::PARAM_INT);
    $result_eum -> bindParam(':lid', $lid, PDO::PARAM_INT);
    $result_eum -> execute();
    $data_eum = $result_eum -> fetchAll();

    $query_entradas = "SELECT lugares.lid, lugares.lnombre, museos.precio, entradas.f_compra
                        FROM eum, entradas, museos, lugares 
                        WHERE eum.uid=:id AND eum.eid=entradas.eid AND eum.lid=museos.lid AND museos.lid=lugares.lid;";
    $result_entradas = $db8 -> prepare($query_entradas);
    $result_entradas -> bindParam(':id', $uid, PDO::PARAM_INT);
    $result_entradas -> execute();
    $data_entradas = $result_entradas -> fetchAll();
?>

<?php include('../templates/header.html'); ?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Compra de entrada realizada</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <h3>Datos de la compra</h3>
            <table class="custom">
            <tr>
                <th>Nombre del usuario</th><th>Nombre museo</th><th>Precio</th><th>Fecha de compra</th>
            </tr>
            <?php
                foreach($data_entradas as $entrada){
                    echo "<tr><td>$unombre</td><td><a href='vista_por_lugar.php?id=$entrada[0]'>$entrada[1]</a></td><td>$entrada[2]</td><td>$entrada[3]</td></tr>";
                }
            ?> 
            </table>
            <div style="text-align: center;">
                <a href="vista_entradas.php" class="btn btn-special no-icon" style="margin:0;border-radius: 5px;">Entradas</a>
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