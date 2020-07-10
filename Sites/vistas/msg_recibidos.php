<?php
    session_start();
    include('../templates/header.html');
?>
<?php
    $id = $_SESSION["id"];
    $response = file_get_contents("http://go-art.herokuapp.com/messages?id2=$id");
    $response = str_replace("},{", "}~~{", $response);
    $response = substr($response, 1, -2);
    $respuestas = explode("~~", $response);
    $msgs = array();
    foreach($respuestas as $resp){
        $resp = json_decode($resp);
        echo $resp->{'message'};
        array_push($msgs, $resp);
    }
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Mensajes recibidos</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Fecha</th>
                <th>Latitud</th>
                <th>Longitud</th>
                <th>Contenido</th>
                <th>Id mensaje</th>
                <th>Receptor</th>
                <th>Emisor</th>
            </tr>
            <?php
                foreach ($msgs as $m) {
                    echo "<tr><td>$m['date']</td><td>$m['lat']</td><td>$m['long']</td><td>$m['message']</td><td>$m['mid']</td><td>$m['receptant']</td><td>$m['sender']</td></tr>";
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



<?php include('../templates/footer.html'); ?>