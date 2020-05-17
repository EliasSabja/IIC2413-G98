<?php include('../templates/header.html'); ?>

<?php
    $current_aid = $_GET['id'];

    require("../assets/conexion.php");
    $query = "SELECT * FROM (SELECT DISTINCT artistas.aid FROM artistas WHERE artistas.aid=$current_aid EXCEPT SELECT DISTINCT artistas.aid FROM muerte, artistas WHERE artistas.aid=muerte.aid and muerte.fecha_fallecimiento >= Current_date) AS con, artistas WHERE artistas.aid=con.aid;";
    $result = $db8 -> prepare($query);
    $result -> execute();
    $dataCollected1 = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo

    $query2 = "SELECT DISTINCT * FROM artistas, muerte WHERE artistas.aid=muerte.aid AND artistas.aid=$current_aid AND muerte.fecha_fallecimiento < Current_date";
    $result2 = $db8 -> prepare($query2);
    $result2 -> execute();
    $dataCollected2 = $result2 -> fetchAll();

    foreach($dataCollected1 as $d){
        if ($current_aid == $d[0]){
            $dataCollected = $dataCollected1;
        } else{
            $dataCollected = $dataCollected2;
        }
    }
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <?php foreach($dataCollected as $p){
                echo "<h1 class='title'> $p[1] </h1>";
            }
            ?>
        
            <h3>Datos del artista</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Nombre artista</th>
                <th>Fecha de nacimiento</th>
                <?php
                if ($dataCollected == $dataCollected2) {
                        echo "<th>Fecha de fallecimiento</th>";
                    }
                ?>
                <th>Descripción</th>
            </tr>
            <?php if ($dataCollected == $dataCollected1) {
                        foreach($dataCollected as $p){
                            echo "<tr> <td>$p[1]</td><td>$p[2]</td><td>$p[3]</td></tr>";
                        }
                    } else {
                        foreach($dataCollected as $p){
                            echo "<tr> <td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td></tr>";
                        }
                    }
            ?>
            </table>
            </article>
            <hr />
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>