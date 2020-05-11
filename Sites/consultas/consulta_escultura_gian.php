<?php include('../templates/header.html');   ?>

<?php
    require("../config/conexion.php");
    $query = "SELECT LOWER(lnombre) FROM artistas, pinto, obras, lugares WHERE artistas.aid=pinto.aid AND pinto.oid=obras.oid AND obras.lid=lugares.lid AND LOWER(anombre)='gian lorenzo bernini' EXCEPT SELECT LOWER(lnombre) FROM lugares, museos, iglesias WHERE museos.lid=lugares.lid OR iglesias.lid=lugares.lid;";
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
                            <th>Nombre</th>
                        </tr>
                        <?php
                        foreach ($dataCollected as $p) {
                            echo "<tr> <td>$p[0]</td> </tr>";
                        }
                        ?>
                    </table>
                </article>
                <hr />
            </div>
        </div>
<?php include('../templates/footer.html'); ?>