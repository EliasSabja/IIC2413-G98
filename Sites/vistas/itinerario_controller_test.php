<?php include('../templates/header.html'); ?>

<?php $aids = $_POST['artistas_aid'];

    $cid = $_POST['ciudad'];
    $date = $_POST['date'];
    $aids_str = "";

    $empezado = false;
    foreach($aids as $aid){
        if($empezado){
            $aids_str .= ",";
        }
        $aids_str .=  strval($aid);
        if(!$empezado){$empezado = true;}
    }



    require("../assets/conexion.php");
    $query = "SELECT * FROM itinerario(ARRAY [:aids], ':date', :cid);";
    $result = $db8 -> prepare($query);
    $result -> bindParam(':aids', $aids_str, PDO::PARAM_STR);
    $result -> bindParam(':date', $date, PDO::PARAM_STR);
    $result -> bindParam(':cid', $cid, PDO::PARAM_STR);
    $result -> execute();
    $dataCollected = $result -> fetchAll();

    
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Itinerarios disponibles</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <?php
                $previo_it = "-1";
                $primero = true;
                $primero_primero = true;
                $numero = 1;
                foreach($dataCollected as $viaje){

                    if ($viaje[0] != $previo_it){
                        $primero = true;
                        $previo_it = $viaje[0];
                    }   
                    else{$primero = false;}

                    if($primero){
                        if (!$primero_primero){
                             
                            echo"</table><table class='custom'>";
                        }
                        else {
                            $primero_primero = false;
                            echo"<table class='custom'>";
                        }
                        $n = ++$numero;
                        $total = $viaje[1]; 
                        echo"
                        <tr>
                            <th colspan='3'>Itinerario N°$n </th>
                            <th colspan='4'>Precio total: $total </th>
                        </tr>";
                        echo "
                        <tr>
                            <th>Fecha</th>
                            <th>Hora de salida</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>medio</th>
                            <th>Duración</th>
                            <th>Precio</th>
                        </tr>";
                    }
                    $fecha= $viaje[2];
                    $h_salida= $viaje[6];
                    $origen= $viaje[3];
                    $destino= $viaje[4];
                    $medio= $viaje[5];
                    $duracion= $viaje[7];
                    $precio= $viaje[8];
                    echo"
                    <tr>
                        <td>$fecha</td>
                        <td>$h_salida</td>
                        <td>$origen</td>
                        <td>$destino</td>
                        <td>$medio</td>
                        <td>$duracion hrs</td>
                        <td>$precio</td>
                    </tr>
                    ";
                }  
            ?>
            </table>
        </div><br><br>

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
</section>

<?php include('../templates/footer.html'); ?>