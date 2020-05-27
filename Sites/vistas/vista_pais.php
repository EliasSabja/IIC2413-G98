<?php include('../templates/header.html'); ?>

<?php
    $current_pais = $_GET['pais'];

    require("../assets/conexion.php");
    $query = "SELECT cep.cid, ciudades.ciudad FROM cep, ciudades WHERE cep.cid = ciudades.cid AND cep.pais = :pais;"; 

    $result = $db9 -> prepare($query);
    $result -> execute(['pais' => $current_pais]);
    $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo

?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h2 class="title">Elige la ciudad donde se encuentre el hotel en el que quieras reservar</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Ciudad</th>
            </tr>
            <?php
                foreach ($dataCollected as $p) {
                    echo "<tr> <td><a href='vista_ciudad.php?cid=$p[0]'>$p[1]</a></td></tr>";
                }
            ?> 
            </table>
            </article>
            <hr />
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>
