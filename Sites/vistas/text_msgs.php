<?php
    session_start();
    include('../templates/header.html');
?>
<?php
    $url = 'http://go-art.herokuapp.com/text-search';

    $d = $_POST["deseables"];
    $r = $_POST["requeridas"];
    $f = $_POST["prohibidas"];
    $u = $_POST["sender"];

    $fields = array();
    if($d){
        $fields['desired'] = $d;
    }
    if($r){
        $fields['required'] = $r;
    }
    if($f){
        $fields['forbidden'] = $f;
    }
    if($u){
        $fields['userId'] = $u;
    }
    
    $options = array(
        'http' => array(
        'method'  => 'POST',
        'content' => json_encode($fields),
        'header'=>  "TextSearch"
        )
    );
    echo $options["http"]['content'];
    $context  = stream_context_create( $options );
    $response = file_get_contents( $url, false, $context );

    echo $response;
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
            <h1>Resultado búsqueda por texto</h1>
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