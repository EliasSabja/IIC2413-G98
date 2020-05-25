<?php include('../templates/header.html'); ?>

<?php
    $current_lid = $_GET['id'];

    require("../assets/conexion.php");
    $query_museos = "SELECT lugares.lid, lugares.lnombre, museos.hora_apertura, museos.hora_cierre, museos.precio
            FROM lugares, museos
            WHERE lugares.lid=$current_lid AND lugares.lid=museos.lid;";

    $query_plazas = "SELECT lugares.lid, lugares.lnombre
                    FROM lugares
                    WHERE lugares.lid=$current_lid;";

    $query_iglesias = "SELECT lugares.lid, lugares.lnombre, iglesias.hora_apertura, iglesias.hora_cierre
                    FROM lugares, iglesias
                    WHERE lugares.lid=$current_lid AND lugares.lid=iglesias.lid;";

    $result_museos = $db8 -> prepare($query_museos);
    $result_plazas = $db8 -> prepare($query_plazas);
    $result_iglesias = $db8 -> prepare($query_iglesias);

    $result_museos -> execute();
    $result_plazas -> execute();
    $result_iglesias -> execute();

    $dataCollected_museos = $result_museos -> fetchAll();
    $dataCollected_plazas = $result_plazas -> fetchAll();
    $dataCollected_iglesias = $result_iglesias -> fetchAll();

    if ($dataCollected_museos[0]){
        $dataCollected_lugar = $dataCollected_museos;
    } elseif ($dataCollected_iglesias[0]){
        $dataCollected_lugar = $dataCollected_iglesias;
    } else {
        $dataCollected_lugar = $dataCollected_plazas;
    }

    $query_datos_lugar = "SELECT DISTINCT paises.pais, ciudades.ciudad
                    FROM lugares, ciudades, paises 
                    WHERE lugares.lid=$current_lid AND lugares.cid=ciudades.cid AND ciudades.pid=paises.pid;";
    $result_datos_lugar = $db8 -> prepare($query_datos_lugar);
    $result_datos_lugar-> execute();
    $dataCollected_datos_lugar = $result_datos_lugar -> fetchAll();

    $query_obras = "SELECT DISTINCT obras.oid, obras.onombre
                    FROM obras, lugares
                    WHERE lugares.lid=$current_lid AND lugares.lid=obras.lid;";
    $result_obras = $db8 -> prepare($query_obras);
    $result_obras -> execute();
    $dataCollected_obras_lugar = $result_obras -> fetchAll();

    $query_artistas = "SELECT DISTINCT artistas.aid, artistas.anombre
                    FROM lugares, obras, pinto, artistas
                    WHERE lugares.lid=$current_lid AND lugares.lid=obras.lid AND obras.oid=pinto.oid AND pinto.aid=artistas.aid;";
    $result_artistas = $db8 -> prepare($query_artistas);
    $result_artistas -> execute();
    $dataCollected_artistas_lugar = $result_artistas -> fetchAll();
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <?php 
                foreach($dataCollected_lugar as $p){
                    echo "<h1>$p[1]</h1>";
                }
            ?>
            
                <h3>Datos del lugar</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>País</th>
                <th>Ciudad</th>
                <?php
                if ($dataCollected_lugar == $dataCollected_museos) {
                    echo "<th>Hora de apertura</th>";
                    echo "<th>Hora de cierre</th>";
                    echo "<th>Precio</th>";
                } elseif($dataCollected_lugar == $dataCollected_iglesias){
                    echo "<th>Hora de apertura</th>";
                    echo "<th>Hora de cierre</th>";
                }

                ?>
            </tr>
            <?php 
                foreach($dataCollected_datos_lugar as $datos_lugar){
                    echo "<><td>$datos_lugar[0]</td><td>$datos_lugar[1]</td>";
                }

                if ($dataCollected_lugar == $dataCollected_museos) {
                    foreach($dataCollected_lugar as $p){
                        echo "<td>$p[2]</td><td>$p[3]</td><td>$p[4]</td></tr>";
                    }
                } elseif($dataCollected_lugar == $dataCollected_iglesias) {
                    foreach($dataCollected_lugar as $p){
                        echo "<td>$p[2]</td><td>$p[3]</td></tr>";
                    }
                } else{
                    echo "</tr>";
                }
            ?>
            </table>
            </article>
            <hr />
        </div>
    </div>

    <h3>Obras en la exposición</h3>
    <div class="container">
    <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Nombre de la obra</th>
            </tr>
            <?php 
                foreach($dataCollected_obras_lugar as $obra_lugar){
                    echo "<tr><td><a href='vista_por_obra.php?id=$obra_lugar[0]'>$obra_lugar[1]</a></td></tr>";
                }
            ?>
            </table>
            </article>
            <hr />
        </div>
    </div>

    <h3>Artistas que tienen obras en el lugar</h3>
    <div class="container">
    <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Nombre del artista</th>
            </tr>
            <?php 
                foreach($dataCollected_artistas_lugar as $artista_lugar){
                    echo "<tr><td><a href='vista_por_artista.php?id=$artista_lugar[0]'>$artista_lugar[1]</a></td></tr>";
                }
            ?>
            </table>
            </article>
            <hr />
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>