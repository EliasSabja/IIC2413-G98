<?php include('../../templates/session_header.html'); ?>


<section class="section section-destination">
    <div class="section-title" style="padding-top: 110px;">
        <div class="container">
            <h1>Ingresa tus datos para inscribirte</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <form action="controlador_signup.php" method="post" class="subscribe-form">
                <label for="username">Username:</label>
                <!--<input type="text" name="username" class="subscribe-form"><br>-->
                <div class="input-line">
                      <input type="text" name="username" value="" placeholder="Pon tu username aquí" />
                </div><br>

                <label for="nombre">Nombre:</label>
                <!--<input type="text" name="nombre" class="subscribe-form"><br>-->
                <div class="input-line">
                      <input type="text" name="nombre" value="" placeholder="Pon tu nombre aquí" />
                </div><br>

                <label for="direccion">Dirección:</label>
                <!--<input type="text" name="direccion" class="subscribe-form"><br>-->
                <div class="input-line">
                      <input type="text" name="direccion" value="" placeholder="Pon tu dirección aquí" />
                </div><br>

                <label for="correo">Correo:</label>
                <!--<input type="text" name="correo" class="subscribe-form"><br>-->
                <div class="input-line">
                      <input type="text" name="correo" value="" placeholder="Pon tu correo aquí" />
                </div><br>

                <label for="contrasena">Contraseña:</label>
                <!--<input type="password" name="contrasena" class="subscribe-form"><br>-->
                <div class="input-line">
                      <input type="password" name="contrasena" value=""/>
                </div><br>
                <div class="align-center">
                <input type="submit" value="Registrarse" class="btn btn-special no-icon size-2x" style="position: static; border-radius: 5px;">
                </div>
            </form>
            </article>
            <hr />
        </div>
    </div>
</section>


<?php include('../../templates/session_footer.html'); ?>