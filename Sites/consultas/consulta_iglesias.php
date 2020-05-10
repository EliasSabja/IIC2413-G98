<?php include('../templates/header.html');   ?>

<?php
    require("../config/conexion.php");
    $nciudad = $_POST["ciudad"];
    $hora_apertura = $_POST["hora_apertura"];
    $hora_cierre = $_POST["hora_cierre"];
    $query = "SELECT lnombre,onombre FROM (SELECT lugares.lnombre, lugares.lid FROM ciudades,iglesias,lugares WHERE LOWER(ciudades.ciudad) LIKE LOWER('%$nciudad%') AND ciudades.cid=lugares.cid AND lugares.lid=iglesias.lid AND ((iglesias.hora_apertura<='$hora_apertura' AND iglesias.hora_cierre>='$hora_apertura') OR (iglesias.hora_apertura<= '$hora_cierre' AND iglesias.hora_cierre>='$hora_cierre'))) AS abiertas, obras WHERE abiertas.lid=obras.lid EXCEPT (SELECT lnombre, onombre FROM (SELECT lugares.lnombre, lugares.lid FROM ciudades,iglesias,lugares WHERE LOWER(ciudades.ciudad) LIKE LOWER('%$nciudad%') AND ciudades.cid=lugares.cid AND lugares.lid=iglesias.lid AND ((iglesias.hora_apertura<='$hora_apertura' AND iglesias.hora_cierre>='$hora_apertura') OR (iglesias.hora_apertura<='$hora_cierre' AND iglesias.hora_cierre>='$hora_cierre'))) AS abiertas,obras,esculturas,pinturas WHERE abiertas.lid=obras.lid AND (obras.oid=esculturas.oid OR obras.oid=pinturas.oid)); ";
    $result = $db -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
?>
        <!-- Main -->
        <div class="wrapper style1">

            <div class="container">
                <article id="main" class="special">
                    <table class="custom">
                        <tr>
                            <th>Nombre iglesia</th>
                            <th>Nombre fresco</th>
                        </tr>
                        <?php
                        foreach ($dataCollected as $p) {
                            echo "<tr> <td>$p[0]</td> <td>$p[1]</td> </tr>";
                        }
                        ?>
                    </table>
                </article>
                <hr />
            </div>
        </div>
<?php include('../templates/footer.html'); ?>
