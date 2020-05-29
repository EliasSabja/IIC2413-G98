<?php
    require("../assets/conexion.php");
    $query_ciudades = "SELECT ciudad, cid FROM ciudades;";
    $result_ciudades = $db9 -> prepare($query_ciudades);
    $result_ciudades -> execute();
    $data = $result_ciudades -> fetchAll();
?>



<?php include('../templates/header.html'); ?>

<?php
    $hid = $_GET['hid'];
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Comprar ticket de viaje</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <form action='vista_elegir_viajes.php' method='post' class='subscribe-form'>
            <table class="custom">
                <tr>
                    <th colspan="2">Fecha de viaje</th>
                </tr>
              
                <tr>
                    <td colspan="2">
                        <div class="input-line">
                            <input id="date" type="date" name="date" min=
                                <?php
                                    echo date('Y-m-d');
                                ?>
                            >
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>Fecha Check-in</th><th>Fecha Check-out</th>
                </tr>

                <tr>
                    <td>
                        <div class="input-line">
                            <!--Dropdown-->
                            <select name="ciudad_origen" id="ciudad_origen">
                                <?php
                                foreach ($data as $p) {
                                    echo "<option value='$p[1]'>$p[0]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </td>

                    <td>
                        <div class="input-line">
                            <!--Dropdown-->
                            <select name="ciudad_destino" id="ciudad_destino">
                                <?php
                                foreach ($data as $p) {
                                    echo "<option value='$p[1]'>$p[0]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="align-center">
                        <input type="submit" value="Ver viajes" class="btn btn-special no-icon size-2x" style="position: static; border-radius: 5px;">
                        </div>
                    </td>
                </tr>
            </table>
            </form>

            </article>

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
            <hr />
        </div>
    </div>
</section>

<?php include('../templates/footer.html'); ?>