<?php session_start(); ?>
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
                  <img src="img/site-identity.png" alt="site identity" />
               </a>

               <nav class="site-nav">
                  <ul class="clean-list site-links">
                     <li>
                        <a href="#"> 
                           <?php
                           if ($_SESSION["nombre"]) {
                              echo "HOLA ";
                              echo $_SESSION["nombre"];
                              echo "!!";
                           }
                           ?> 
                        </a>
                     </li>
                     <?php 
                     if ($_SESSION["nombre"]){
                        echo "<li><a href='#'>Perfil</a></li>";
                     }
                     ?>
                  </ul>
                  <?php 
                     if (!$_SESSION["nombre"]){
                        echo "<a href='vistas/session/vista_signup.php' class='btn btn-outlined' style='margin:3px;'>Sign up</a>
                        <a href='vistas/session/vista_login.php' class='btn btn-outlined' style='margin:3px;'>Log in</a>";
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
            <div class="hero-box">
               <div class="container">
                  <div class="hero-text align-center">
                     <h1>Reserve a boat now!</h1>

                     <form id="ver_artistas" action ="vistas/vista_artistas.php" method="post">
                              <div class="container">
                                 <article id="main">
                                    <header>
                                          <h2><a onclick="document.getElementById('ver_artistas').submit()">Ver artistas</a></h2>
                                    </header>
                                 <hr />
                              </div>
                        </div>
                     </form>
                     <p>and set your sails into paradise!</p>
                  </div>

                  <form class="destinations-form">
                     <div class="input-line">
                        <input type="text" name="destination" value="" class="form-input check-value" placeholder="WHAT IS YOUR DESTINATION, SAILOR?" />
                        <button type="button" name="destination-submit" class="form-submit btn btn-special">Find a boat</button>
                     </div>
                  </form>
               </div>
            </div>

            <!-- Statistics Box -->
            <div class="container">
               <div class="statistics-box">
                  <div class="statistics-item">
                     <span class="value">2,300</span>
                     <p class="title">Destinations</p>
                  </div>

                  <div class="statistics-item">
                     <span class="value">1,000</span>
                     <p class="title">Cities</p>
                  </div>

                  <div class="statistics-item">
                     <span class="value">35,000</span>
                     <p class="title">Boats</p>
                  </div>

                  <div class="statistics-item">
                     <span class="value">50,000</span>
                     <p class="title">Sailors</p>
                  </div>
               </div>
            </div>
         </section>

         <!-- Destinations Section -->
         <section class="section section-destination">
            <!-- Title -->
            <div class="section-title">
               <div class="container">
                  <h2 class="title">Explore our top destinations</h2>
                  <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et</p>
               </div>
            </div>

            <!-- Content -->
            <div class="container">
               <div class="row">
                  <div class="col-md-16 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="#">
                              <img src="img/destination-1.jpg" alt="destination image" />
                           </a>
                        </div>

                        <span class="boats-qty">730</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Figueira da Fox</h4>
                              <p class="country">Portugal</p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-8 col-sm-12 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="#">
                              <img src="img/destination-2.jpg" alt="destination image" />
                           </a>
                        </div>

                        <span class="boats-qty">621</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Ibiza</h4>
                              <p class="country">Spain</p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-8 col-sm-12 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="#">
                              <img src="img/destination-3.jpg" alt="destination image" />
                           </a>
                        </div>

                        <span class="boats-qty">543</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Palma de Mallorca</h4>
                              <p class="country">Spain</p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-8 col-sm-12 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="#">
                              <img src="img/destination-4.jpg" alt="destination image" />
                           </a>
                        </div>

                        <span class="boats-qty">495</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Portofino</h4>
                              <p class="country">Italy</p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-8 col-sm-12 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="#">
                              <img src="img/destination-5.jpg" alt="destination image" />
                           </a>
                        </div>

                        <span class="boats-qty">402</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Port Hercules</h4>
                              <p class="country">Monaco</p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="load-destinations-box">
                     <div class="col-md-8 col-sm-12 col-xs-24">
                        <div class="destination-box">
                           <div class="box-cover">
                              <a href="#">
                                 <img src="img/destination-4.jpg" alt="destination image" />
                              </a>
                           </div>

                           <span class="boats-qty">495</span>

                           <div class="box-details">
                              <div class="box-meta">
                                 <h4 class="city">Portofino</h4>
                                 <p class="country">Italy</p>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-8 col-sm-12 col-xs-24">
                        <div class="destination-box">
                           <div class="box-cover">
                              <a href="#">
                                 <img src="img/destination-5.jpg" alt="destination image" />
                              </a>
                           </div>

                           <span class="boats-qty">402</span>

                           <div class="box-details">
                              <div class="box-meta">
                                 <h4 class="city">Port Hercules</h4>
                                 <p class="country">Monaco</p>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-8 col-sm-12 col-xs-24">
                        <div class="destination-box">
                           <div class="box-cover">
                              <a href="#">
                                 <img src="img/destination-3.jpg" alt="destination image" />
                              </a>
                           </div>

                           <span class="boats-qty">543</span>

                           <div class="box-details">
                              <div class="box-meta">
                                 <h4 class="city">Palma de Mallorca</h4>
                                 <p class="country">Spain</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="align-center">
                  <a href="#" class="btn btn-default btn-load-destination"><span class="text">Explore more destinations</span><i class="icon-spinner6"></i></a>
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

         <!-- Boats Section -->
         <section class="section section-boats">
            <!-- Title -->
            <div class="section-title">
               <div class="container">
                  <h2 class="title">Featured boats</h2>
                  <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
               </div>
            </div>

            <!-- Content -->
            <div class="container">
               <div class="row">
                  <div class="col-sm-12 col-xs-24">
                     <div class="boat-box">
                        <div class="box-cover">
                           <img src="img/boat-1.jpg" alt="destination image" />
                        </div>

                        <span class="boat-price">€580 / day</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="boat-name">Delphia 47</h4>
                              <ul class="clean-list boat-meta">
                                 <li class="location">Gdansk, Poland</li>
                                 <li class="berths">8 Berths</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-sm-12 col-xs-24">
                     <div class="boat-box">
                        <div class="box-cover">
                           <img src="img/boat-2.jpg" alt="destination image" />
                        </div>

                        <span class="boat-price">€950 / day</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="boat-name">Sense 55</h4>
                              <ul class="clean-list boat-meta">
                                 <li class="location">Portofino, Itali</li>
                                 <li class="berths">12 Berths</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-sm-12 col-xs-24">
                     <div class="boat-box">
                        <div class="box-cover">
                           <img src="img/boat-3.jpg" alt="destination image" />
                        </div>

                        <span class="boat-price">€820 / day</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="boat-name">Cruiser 51</h4>
                              <ul class="clean-list boat-meta">
                                 <li class="location">Palma de Mallorca, Spain</li>
                                 <li class="berths">10 Berths</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-sm-12 col-xs-24">
                     <div class="boat-box">
                        <div class="box-cover">
                           <img src="img/boat-4.jpg" alt="destination image" />
                        </div>

                        <span class="boat-price">€400 / day</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="boat-name">Cruiser 41S</h4>
                              <ul class="clean-list boat-meta">
                                 <li class="location">Lisbon, Portugal</li>
                                 <li class="berths">8 Berths</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="load-boats-box">
                     <div class="col-sm-12 col-xs-24">
                        <div class="boat-box">
                           <div class="box-cover">
                              <img src="img/boat-2.jpg" alt="destination image" />
                           </div>

                           <span class="boat-price">€950 / day</span>

                           <div class="box-details">
                              <div class="box-meta">
                                 <h4 class="boat-name">Sense 55</h4>
                                 <ul class="clean-list boat-meta">
                                    <li class="location">Portofino, Itali</li>
                                    <li class="berths">12 Berths</li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-sm-12 col-xs-24">
                        <div class="boat-box">
                           <div class="box-cover">
                              <img src="img/boat-1.jpg" alt="destination image" />
                           </div>

                           <span class="boat-price">€580 / day</span>

                           <div class="box-details">
                              <div class="box-meta">
                                 <h4 class="boat-name">Delphia 47</h4>
                                 <ul class="clean-list boat-meta">
                                    <li class="location">Gdansk, Poland</li>
                                    <li class="berths">8 Berths</li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="align-center">
                  <a href="#" class="btn btn-default btn-load-boats"><span class="text">Load more boats</span><i class="icon-spinner6"></i></a>
               </div>
            </div>
         </section>
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