<?php include('../templates/header.html'); ?>

<?php
    $current_oid = $_GET['id'];

    require("../assets/conexion.php");
    $query = "SELECT DISTINCT obras.onombre, obras.fecha_inicio, obras.fecha_culminacion, periodo.periodo
            FROM obras, periodo
            WHERE obras.oid=:obra_oid AND obras.fecha_inicio=periodo.fecha_inicio AND obras.fecha_culminacion=periodo.fecha_culminacion;";
    $result = $db8 -> prepare($query);
    $result -> execute([ 'obra_oid' => $current_oid ]);
    $dataCollected_current_obra = $result -> fetchAll();

    $query_artistas = "SELECT DISTINCT artistas.aid, artistas.anombre
                    FROM artistas, pinto, obras 
                    WHERE obras.oid=:obra_oid AND artistas.aid=pinto.aid AND obras.oid=pinto.oid;";
    $result_artistas = $db8 -> prepare($query_artistas);
    $result_artistas -> execute([ 'obra_oid' => $current_oid ]);
    $dataCollected_artistas = $result_artistas -> fetchAll();

    $query_lugares = "SELECT DISTINCT lugares.lid, lugares.lnombre, ciudades.ciudad, paises.pais
                    FROM obras, lugares, ciudades, paises 
                    WHERE obras.oid=:obra_oid AND obras.lid=lugares.lid AND lugares.cid=ciudades.cid AND ciudades.pid=paises.pid;";
    $result_lugares = $db8 -> prepare($query_lugares);
    $result_lugares -> execute([ 'obra_oid' => $current_oid ]);
    $dataCollected_lugares = $result_lugares -> fetchAll();

?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
           <?php 
             foreach($dataCollected_current_obra as $p){
                 echo "<h1>$p[0]</h1>";
             }
           ?>
        
            <h3>Datos de la obra</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Fecha de inicio</th>
                <th>Fecha de culminación</th>
                <th>Periodo</th>
            </tr>
            <?php 
                foreach($dataCollected_current_obra as $p){
                    echo "<tr> <td>$p[1]</td><td>$p[2]</td><td>$p[3]</td></tr>";
                }
            ?>
            </table>
            </article>
            <hr />
        </div>
    </div>
    <div style="text-align:center">
    <h3>Artistas participantes</h3>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Nombre artista</th>
            </tr>
            <?php 
                foreach($dataCollected_artistas as $p){
                    echo "<tr> <td><a href='vista_por_artista.php?id=$p[0]'>$p[1]</a></td></tr>";
                }
            ?>
            </table>
            </article>
            <hr />
        </div>
    </div>
    <div style="text-align:center">
    <h3>Lugar en que se encuentra la obra</h3>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Nombre lugar</th>
                <th>Ciudad</th>
                <th>País</th>
            </tr>
            <?php 
                foreach($dataCollected_lugares as $p){
                    echo "<tr> <td><a href='vista_por_lugar.php?id=$p[0]'>$p[1]</a></td><td>$p[2]</td><td>$p[3]</td></tr>";
                }
            ?>
            </table>
            </article>
            <hr />
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>