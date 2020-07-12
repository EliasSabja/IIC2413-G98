
<?php include('../templates/header.html'); ?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Buscar ubicación de mensajes</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <form action='msg_mapa.php' method='post' class='subscribe-form'>
            <table class="custom">
                <tr>
                    <th colspan="2">Rango de fechas para la búsqueda</th>
                </tr>
                <tr>
                    <td><label for="date_i">Fecha inicial</label> </td> <td><label for="date_f"> Fecha final</label></td>
                </tr>
                <tr>
                    <td>
                        <div class="input-line">
                            <input id="date_i" type="date" name="date_i">
                        </div>
                    </td>
                    <td>
                        <div class="input-line">
                            <input id="date_f" type="date" name="date_f">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="align-center">
                        <input type="submit" value="Buscar mensajes" class="btn btn-special no-icon size-2x" style="position: static; border-radius: 5px;">
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