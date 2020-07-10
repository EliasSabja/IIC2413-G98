<?php include('../templates/header.html'); ?>

<div class="row">
    <div class = 'col-md-24' style='text-align: center;padding:20px;'>
        <a href='msg_enviar.php'class='btn btn-special no-icon'style='margin:0 auto;border-radius: 5px;'>Enviar Mensajes</a>
    </div>
    <div class = 'col-md-24' style='text-align: center;padding:20px;'>
        <a href='msg_recibidos.php'class='btn btn-special no-icon'style='margin:0 auto;border-radius: 5px;'>Mensajes Recibidos</a>
    </div>
    <div class = 'col-md-24' style='text-align: center;padding:20px;'>
        <a href='msg_enviados.php'class='btn btn-special no-icon'style='margin:0 auto;border-radius: 5px;'>Mensajes Enviados</a>
    </div>
    <div class = 'col-md-24' style='text-align: center;padding:20px;'>
        <a href='msg_text.php'class='btn btn-special no-icon'style='margin:0 auto;border-radius: 5px;'>Búsqueda por Texto</a>
    </div>
    <div class = 'col-md-24' style='text-align: center;padding:20px;'>
        <a href='msg_mapa.php'class='btn btn-special no-icon'style='margin:0 auto;border-radius: 5px;'>Mapa Mensajes</a>
    </div>
</div>

<!-- Go back -->
<div class="row" style="padding:20px;">
    <!-- Spacer -->
    <div class = "col-md-6 col " style="text-align: center;padding:20px;"></div>
        <!-- Button -->
        <div class = "col-md-12 " style="text-align: center;padding:20px;">
            <a href="../index.php" class="btn btn-special no-icon" style="margin:5px 20px;border-radius: 5px; width: 146px;">Atras</a>
        </div>
    <!-- Spacer -->
    <div class = "col-md-6 " style="text-align: center;padding:20px;"></div>
</div>



<?php include('../templates/footer.html'); ?>