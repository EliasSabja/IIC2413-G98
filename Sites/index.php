<?php session_start();?>

<!DOCTYPE html>
<html>
   <head>
      <title>Home</title>
      <meta charset="utf-8">
      <meta name="description" content="Traveling HTML5 Template" />
      <meta name="author" content="Design Hooks" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Raleway:400,700" rel="stylesheet" />
      <link href="css/screen.css" rel="stylesheet" />
   </head>
   <body class="home" id="page">

      <!-- Header -->
      <header class="main-header">
         <div class="container">
            <div class="header-content">
               <a href="index.php">
                  <img src="img/site-identity.png" alt="site identity" id="logo"/>
               </a>

               <nav class="site-nav">
                  <ul class="clean-list site-links">
                     <li>
                        <h4> 
                           <?php
                           if ($_SESSION["nombre"]) {
                              echo "Hola ";
                              echo $_SESSION["nombre"];
                              echo "!!";
                           }
                           ?> 
                        </h4>
                     </li>
                     <?php 
                     if ($_SESSION["nombre"]){
                        echo "<li><a class='btn btn-outlined' style='margin:0px 6px;' href='vistas/vista_perfil.php'>Perfil</a></li>";
                     }
                     ?>
                  </ul>
                  <?php 
                     if (!$_SESSION["nombre"]){
                        echo "<a href='vistas/session/vista_signup.php' class='btn btn-outlined' style='margin:0px 6px;'>Sign up</a>
                        <a href='vistas/session/vista_login.php' class='btn btn-outlined' style='margin:0px 6px;'>Log in</a>";
                     }
                  ?>
                  
               </nav>
            </div>
         </div>
      </header>

      <!-- Main Content -->
      <div class="content-box">
         <!-- Hero Section -->
         <section class="section section-hero">
            <div class="hero-box" style="padding-bottom:150px;">
               <div class="container">
                  <div class="hero-text align-center">
                     <h1>¡Reserva un viaje ahora!</h1>
                     <hr>
                     <p class="hero-text">Descubre un nuevo mundo con nosotros</p>
                  </div>
               </div>
               
               <div class = "col-md-24 " style="text-align: center;padding:20px; border:solid;">
                  <a href="vistas/vista_itinerario.php"class="btn btn-special no-icon"style="margin:0 auto;border-radius: 5px;">Crea tu itinerario</a>
               </div>

               <!--botones-->
               <div class="row">

                  <div class="col-md-8">
                  </div>

                  <div class="col-md-4" style="text-align:center;">
                  <a href="vistas/vista_comprar_ticket.php"class="btn btn-special no-icon" style="margin:5px 20px;border-radius: 5px;">Viajes</a>
                  </div>
                  
                  <div class="col-md-4" style="text-align:center;">
                  <a href="vistas/vista_hacer_reserva.php"class="btn btn-special no-icon" style="margin:5px 20px;border-radius: 5px;">Hoteles</a>
                  </div>
                  
                  <div class="col-md-8">
                  </div>

               </div>
            </div>

            <!-- Statistics Box -->
            <div class="container">
               <div class="statistics-box">
                  <div class="statistics-item">
                     <span class="value">5</span>
                     <p class="title">Lugares de interes</p>
                  </div>

                  <div class="statistics-item">
                     <span class="value">12</span>
                     <p class="title">Ciudades</p>
                  </div>

                  <div class="statistics-item">
                     <span class="value">23</span>
                     <p class="title">Hoteles</p>
                  </div>

                  <div class="statistics-item">
                     <span class="value">At least 3</span>
                     <p class="title">Usuarios</p>
                  </div>
               </div>
            </div>
         </section>

         <!-- Destinations Section -->
         <section class="section section-destination" style="margin-top:50px;">
            <!-- Title -->
            <div class="section-title">
               <div class="container">
                  <h2 class="title">Explora nuestros servicios</h2>
                  <p class="sub-title"></p>
               </div>
            </div>

            <!-- Content -->
            <div class="container">
               <div class="row">

                  <!-- Artistas -->
                  <div class="col-md-8 col-sm-12 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="vistas/vista_artistas.php"> <!-- ref -->
                              <img src="img/destination-2.jpg" alt="destination image" />
                           </a>
                        </div>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Artistas</h4>
                              <p class="country"></p><!-- detalles -->
                           </div>
                        </div>
                     </div>
                  </div>

                  <!--Obras-->
                  <div class="col-md-8 col-sm-12 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="vistas/vista_obras.php"> <!-- ref -->
                              <img src="img/destination-4.jpg" alt="destination image" />
                           </a>
                        </div>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Obras</h4>
                              <p class="country"></p><!-- detalles -->
                           </div>
                        </div>
                     </div>
                  </div>

                  <!--Lugares de interes -->
                  <div class="col-md-8 col-sm-12 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="vistas/vista_lugares.php"> <!-- ref -->
                              <img src="img/destination-3.jpg" alt="destination image" />
                           </a>
                        </div>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Lugares de interes</h4>
                              <p class="country">Museos, iglesias y plazas</p><!-- detalles -->
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
         </section>        
      </div>

      <!--footer-->
      <footer class="main-footer">
         <div class="container">
            <div class="row">

               <div class="col-md-5">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Servicios</h5>
                     <ul>
                        <li><a href="vistas/vista_artistas.php">Artistas</a></li>
                        <li><a href="vistas/vista_obras.php">Obras</a></li>
                        <li><a href="vistas/vista_lugares.php">Lugares de interes</a></li>
                     </ul>
                  </div>
               </div>

               <!--
               <div class="col-md-5">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Comprar</h5>
                     <ul>
                        <li><a href="#">Ticket</a></li>
                        <li><a href="#">Reserva</a></li>
                        <li><a href="#">Entrada</a></li>
                     </ul>
                  </div>
               </div>
               -->

               
               <div class="col-md-5">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Autores</h5>
                     <ul>
                        <li><a href="https://www.instagram.com/diegoemilio01/?hl=es-la" target="_blank">Diego Bustamante</a></li>
                        <li><a href="https://www.instagram.com/luckbox314/?hl=es-la" target="_blank">Lucas Muñoz</a></li>
                        <li><a href="https://www.instagram.com/eli_sabja/?hl=es-la" target="_blank">Elias Sabja</a></li>
                        <li><a href="#">Cristobal</a></li>

                     </ul>
                  </div>
               </div>
               
            </div>
         </div>
      </footer>

      <!-- Scripts -->
      <script src="js/jquery.js"></script>
      <script src="js/functions.js"></script>
   </body>
</html>