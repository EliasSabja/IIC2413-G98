<?php 
    session_start(); 

    if (!$_SESSION["nombre"]) {
        header("Location: ../index.php");
        die();
    }

    include('../templates/header.html');

    require("../assets/conexion.php");
    $id = $_SESSION["id"];
    $query = "SELECT username, nombre, direccion, correo FROM usuarios WHERE uid='$id';";
    $result = $db9 -> prepare($query);
    $result -> execute();
    $datos = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
?>

<section class="section section-destination">

    <div class="section-title">
        <div class="container" style="margin-top:100px;margin-bottom:5px;">
            <?php
                $nombre = $_SESSION["nombre"];
                echo "<h2 class='title'>Perfil de $nombre </h2>";
            ?>
        </div>
    </div>

    <div class="container-fluid" style="margin:10px 50px;">
        <!-- Datos de usuario -->
        <div class="section-title" style="text-align:left;">
            <?php
                $username= $datos[0][0];
                $nombre= $datos[0][1];
                $dirección= $datos[0][2];
                $correo= $datos[0][3];
                echo "<h2 class='title'>Username: $username </h2>";
                echo "<h2 class='title'>Nombre: $nombre </h2>";
                echo "<h2 class='title'>Dirección: $dirección </h2>";
                echo "<h2 class='title'>Correo: $correo </h2>";
            ?>
        </div>
        <!-- Datos de compras -->
        <div class="row" style="padding:20px;">

            <!-- Entradas -->
            <div class = "col-md-8 " style="text-align: center;padding:20px;" >
                <div style="border:solid;padding:5px;border-radius:5px;">
                    <h1> Entradas </h1>
                    <p>Revisa todas tus Entradas a museos</p>
                    <a href="#" class="btn btn-special no-icon" style="margin:0;border-radius: 5px;">Go</a>
                </div>
            </div>
            
            <!-- Reservas -->
            <div class = "col-md-8 " style="text-align: center;padding:20px;">
                <div style="border:solid;padding:5px;border-radius:5px;">
                    <h1> Reservas</h1>
                    <p>Revisa todas tus reservas en hoteles</p>
                    <a href="vista_reservas.php" class="btn btn-special no-icon" style="margin:0;border-radius: 5px;">Go</a>
                </div>
            </div>

            <!-- Tickets -->
            <div class = "col-md-8 " style="text-align: center;padding:20px;">
                <div style="border:solid;padding:5px;border-radius:5px;">   
                    <h1> Tickets </h1>
                    <p>Revisa todos tus tickets para viajes</p>
                    <a href="vista_tickets.php" class="btn btn-special no-icon" style="margin:0;border-radius: 5px;">Go</a>
                </div>
            </div>
        </div>

        <!-- Atras y log out -->
        <div class="row" style="padding:20px;">

            <!-- Spacer -->
            <div class = "col-md-6 col " style="text-align: center;padding:20px;"></div>

            <!-- Buttons -->
            <div class = "col-md-12 " style="text-align: center;padding:20px;">
                <a href="../index.php"class="btn btn-special no-icon" style="margin:5px 20px;border-radius: 5px; width: 146px;">Atras</a>
                <a href="session/controlador_logout.php" class="btn btn-special no-icon" style="margin:5px 20px;border-radius: 5px; width: 146px;">Log out</a>
            </div>

            <!-- Spacer -->
            <div class = "col-md-6 " style="texgitt-align: center;padding:20px;"></div>

        </div>

        <!-- Borrar -->
        <div class="row" style="padding:20px;margin-top:100px;">

            <div class = "col-md-24 " style="text-align: center;padding:20px; border:solid;">
                <h1>Danger zone</h1>
                <a href="session/controlador_delete.php" onclick="return confirm('¿Estás seguro de querer borrar tu perfil?');" class="btn btn-special no-icon" style="border-radius: 5px;">Borrar Cuenta</a>
                <br><p> borrar tu cuenta implica que no podrás volver a logearte nunca más.</p>
            </div>

        </div>
    
    </div>
</section>

<?php include('../templates/footer.html'); ?>