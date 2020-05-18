<?php include('../../templates/session_header.html'); ?>


<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h2 class="title">Ingresa tus datos para loggearte</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <form action="controlador_login.php" method="post" class="subscribe-form">
                <label for="correo">Correo:</label>
                <div class="input-line">
                      <input type="text" name="correo" value="" placeholder="Pon tu correo aquí" />
                </div>
                <!--
                <input type="text" name="correo" class="subscribe-form"> --><br>
                <label for="contrasena">Contraseña:</label>
                <div class="input-line">
                      <input type="password" name="contrasena" value="" />
                </div>
                <!--<input type="password" name="contrasena" class="subscribe-form"><br>-->
                <input type="submit" value="Loguearse" class="subscribe-form btn" style="position: static;">
                <button type="button" name="subscribe-submit" class="btn no-icon">Logearse</button>
            </form>
            </article>
            <hr />
        </div>
    </div>
</section>


<?php include('../../templates/session_footer.html'); ?>