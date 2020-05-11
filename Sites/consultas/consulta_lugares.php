<?php include('../templates/header.html');   ?>

<?php
    require("../config/conexion.php");
    $query = "SELECT lnombre FROM (SELECT lnombre, COUNT(DISTINCT periodo) AS Hola FROM Lugares, Obras, Periodo WHERE Lugares.lid = Obras.lid AND Obras.fecha_inicio = Periodo.fecha_inicio AND Obras.fecha_culminacion = Periodo.fecha_culminacion GROUP BY Lugares.lid) AS Periodos_lugares WHERE Periodos_lugares.Hola = (SELECT COUNT (DISTINCT periodo) FROM Periodo); ";
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
                        <th>Nombre lugares</th>
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