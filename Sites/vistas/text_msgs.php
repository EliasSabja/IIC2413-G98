<?php
    session_start();
    include('../templates/header.html');
?>
<?php
    $url = 'http://go-art.herokuapp.com/text-search';

    $fields = array(
    'desired' => $_POST["deseables"],
    'required' => $_POST["requeridas"],
    'forbidden' => $_POST["prohibidas"],
    'userId' => $_POST["sender"]
    );
    echo $fields['deseables'];
    $postvars = http_build_query($fields);
    echo $postvars;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);

    $response = curl_exec($ch);
    echo $response;

    curl_close($ch);

    $response = str_replace("},{", "}~~{", $response);
    $response = substr($response, 1, -2);
    $respuestas = explode("~~", $response);
    $msgs = array();
    foreach($respuestas as $resp){
        $resp = json_decode($resp);
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
                    $f = $m->{'date'};
                    $la = $m->{'lat'};
                    $lo = $m->{'long'};
                    $me = $m->{'message'};
                    $mid = $m->{'mid'};
                    $r = $m->{'receptant'};
                    $s = $m->{'sender'};
                    echo "<tr><td>$f</td><td>$la</td><td>$lo</td><td>$me</td><td>$mid</td><td>$r</td><td>$s</td></tr>";
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