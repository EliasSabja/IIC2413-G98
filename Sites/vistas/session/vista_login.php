<?php include('../../templates/session_header.html'); ?>


<section class="section section-destination">
    <div class="section-title" style="padding-top: 110px;">
        <div class="container">
            <h1>Ingresa tus datos para loggearte</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <form action="controlador_login.php" method="post" class="subscribe-form">
                <label for="correo">Correo:</label>
                <div class="input-line">
                      <input type="text" name="correo" value="" placeholder="Pon tu correo aquí" />
                </div><br>
                <!--
                <input type="text" name="correo" class="subscribe-form"> -->
                <label for="contrasena">Contraseña:</label>
                <div class="input-line">
                      <input type="password" name="contrasena" value="" />
                </div><br>
                <!--<input type="password" name="contrasena" class="subscribe-form">-->
                <div class="align-center">
                <input type="submit" value="Loguearse" class="btn btn-special no-icon size-2x" style="position: static; border-radius: 5px;">
                </div>
            </form>
            </article>
            <hr />
        </div>
    </div>
</section>


<?php include('../../templates/session_footer.html'); ?>