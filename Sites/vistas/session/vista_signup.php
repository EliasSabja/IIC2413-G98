<?php include('../../templates/session_header.html'); ?>


<section class="section section-destination">
    <div class="section-title">
        <div class="container">
            <h2 class="title">Ingresa tus datos para inscribirte</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <article>
            <form action="controlador_signup.php" method="post" class="subscribe-form">
                <label for="username">Username:</label>
                <input type="text" name="username" class="subscribe-form"><br>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="subscribe-form"><br>
                <label for="direccion">Direccion:</label>
                <input type="text" name="direccion" class="subscribe-form"><br>
                <label for="correo">Correo:</label>
                <input type="text" name="correo" class="subscribe-form"><br>
                <label for="contrasena">Contraseña:</label>
                <input type="text" name="contrasena" class="subscribe-form"><br>
                <input type="submit" value="Loguearse" class="subscribe-form btn" style="position: static;">
            </form>
            </article>
            <hr />
        </div>
    </div>
</section>


<?php include('../../templates/session_footer.html'); ?>