<?php
    session_start();
    include('../templates/header.html');
?>

<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h1>Enviar mensaje</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <form action='controlador_enviar.php' method='post' class='subscribe-form'>
            <table class="custom">
                <tr>
                    <th>Username</th>
                    <th>Contenido</th>
                </tr>
                <tr>
                    <td>
                        <div class="input-line">
                            <input type="text" name="username">
                        </div>
                    </td>
                    <td>
                        <div class="input-line">
                            <input type="text" name="contenido">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="align-center">
                        <input type="submit" value="Enviar" class="btn btn-special no-icon size-2x" style="position: static; border-radius: 5px;">
                        </div>
                    </td>
                </tr>
            </table>
            </form>
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