<?php session_start();
    include('../templates/header.html'); 
?>

<?php
    $id = $_SESSION["id"];

    require("../assets/conexion.php");

    $query_entradas = "SELECT lugares.lid, lugares.lnombre, museos.precio, entradas.f_compra
                        FROM eum, entradas, museos, lugares 
                        WHERE eum.uid=:id AND eum.eid=entradas.eid AND eum.lid=museos.lid AND museos.lid=lugares.lid;";
    $result_entradas = $db8 -> prepare($query_entradas);
    $result_entradas -> bindParam(':id', $id, PDO::PARAM_INT);
    $result_entradas -> execute();
    $data_entradas = $result_entradas -> fetchAll();
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Encuentra aquí todas las entradas que has comprado!</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Nombre lugar</th>
                <th>Precio de la entrada</th>
                <th>Fecha de compra</th>
            </tr>
            <?php
                foreach ($data_entradas as $p) {
                    echo "<tr> <td><a href='vista_por_lugar.php?id=$p[0]'>$p[1]</a></td><td>$p[2]</td><td>$p[3]</td></tr>";
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

<?php include('../templates/footer.html');?>