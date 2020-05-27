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

                     <form id="ver_artistas" action ="vistas/vista_artistas.php" method="post">
                        <div class="container">
                           <article id="main">
                              <header>
                                    <h2><a onclick="document.getElementById('ver_artistas').submit() " class='btn btn-outlined'>Ver artistas</a></h2>
                              </header>
                           <hr>
                           </article>
                        </div>
                     </form>
                     <p class="hero-text">Descubre un nuevo mundo con nosotros</p>
                  </div>
               <!--</div>

                  <form class="destinations-form">
                     <div class="input-line">
                        <input type="text" name="destination" value="" class="form-input check-value" placeholder="WHAT IS YOUR DESTINATION, SAILOR?" />
                        <button type="button" name="destination-submit" class="form-submit btn btn-special">Find a boat</button>
                     </div>
                  </form>
               </div> -->
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
                           <a href="#"> <!-- ref -->
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
                           <a href="#"> <!-- ref -->
                              <img src="img/destination-3.jpg" alt="destination image" />
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
                           <a href="#"> <!-- ref -->
                              <img src="img/destination-4.jpg" alt="destination image" />
                           </a>
                        </div>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Lugares de interes</h4>
                              <p class="country">Museos e iglesias</p><!-- detalles -->
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
         </section>

         <!-- Parallax Box -->
         <div class="parallax-box">
            <div class="container">
               <div class="text align-center">
                  <h1>Have your own boat?</h1>
                  <p>navigare necesse est, vivere non est necesse</p>

                  <a href="#" class="btn btn-special no-icon size-2x">Rent your boat</a>
               </div>
            </div>
         </div>
         
      </div>
   <footer class="main-footer">
      <div class="container">
         <div class="row">
            <div class="col-md-5">
               <div class="widget widget_links">
                  <h5 class="widget-title">Top Locations</h5>
                  <ul>
                     <li><a href="#">Lorem impsum dolor</a></li>
                     <li><a href="#">Sit amet consectetur</a></li>
                     <li><a href="#">Adipisicing elit</a></li>
                     <li><a href="#">Eiusmod tempor</a></li>
                     <li><a href="#">incididunt ut labore</a></li>
                  </ul>
               </div>
            </div>

            <div class="col-md-5">
               <div class="widget widget_links">
                  <h5 class="widget-title">Featured Boats</h5>
                  <ul>
                     <li><a href="#">Lorem impsum dolor</a></li>
                     <li><a href="#">Sit amet consectetur</a></li>
                     <li><a href="#">Adipisicing elit</a></li>
                     <li><a href="#">Eiusmod tempor</a></li>
                  </ul>
               </div>
            </div>

            <div class="col-md-9">
               <div class="widget widget_social">
                  <h5 class="widget-title">Subscribe to our newsletter</h5>
                  <form class="subscribe-form">
                     <div class="input-line">
                        <input type="text" name="subscribe-email" value="" placeholder="Your email address" />
                     </div>
                     <button type="button" name="subscribe-submit" class="btn btn-special no-icon">Subscribe</button>
                  </form>

                  <ul class="clean-list social-block">
                     <li>
                        <a href="#"><i class="icon-facebook"></i></a>
                     </li>
                     <li>
                        <a href="#"><i class="icon-twitter"></i></a>
                     </li>
                     <li>
                        <a href="#"><i class="icon-google-plus"></i></a>
                     </li>
                  </ul>
               </div>
            </div>

            <div class="col-md-5">
               <div class="widget widget_links">
                  <h5 class="widget-title">Contact us</h5>
                  <ul>
                     <li><a href="#">Lorem impsum dolor</a></li>
                     <li><a href="#">Sit amet consectetur</a></li>
                     <li><a href="#">Adipisicing elit</a></li>
                     <li><a href="#">Eiusmod tempor</a></li>
                     <li><a href="#">incididunt ut labore</a></li>
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