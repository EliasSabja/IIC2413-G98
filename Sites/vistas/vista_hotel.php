<?php include('../templates/header.html'); ?>

<?php
    $hid = $_GET['hid'];
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Elige los horarios en el que quieras reservar el hotel</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <table class="custom">
            <tr>
                <th>Fecha Check-in</th><th>Fecha Check-out</th>
            </tr>
            <?php
            echo "<form action='vista_reserva.php?hid=$hid' method='post' class='subscribe-form'>";
            ?>
                <tr>
                    <td>
                        <div class="input-line">
                            <input id="in" type="date" name="in" max="2100-05-21" min=
                                <?php
                                    echo date('Y-m-d');
                                ?>
                            >
                        </div>
                    </td>
                    <td>
                        <div class="input-line">
                            <input id="out" type="date" name="out" min=
                                <?php
                                    echo date('Y-m-d');
                                ?>
                            >
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="align-center">
                        <input type="submit" value="Reservar" class="btn btn-special no-icon size-2x" style="position: static; border-radius: 5px;">
                        </div>
                    </td>
                </tr>
            </form>

            </table>
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