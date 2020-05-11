<?php include('../templates/header.html');   ?>

<?php
    require("../config/conexion.php");
    $var = $_POST["pais"];
    $query = "SELECT DISTINCT lnombre FROM paises,ciudades,lugares,museos,obras,periodo WHERE LOWER(paises.pais) LIKE LOWER('%$var%') AND paises.pid=ciudades.pid AND lugares.cid=ciudades.cid AND lugares.lid=museos.lid AND lugares.lid=obras.lid AND obras.fecha_inicio=periodo.fecha_inicio AND obras.fecha_culminacion=periodo.fecha_culminacion AND periodo.periodo='Renacimiento';";
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
                            <th>Nombre museos</th>
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