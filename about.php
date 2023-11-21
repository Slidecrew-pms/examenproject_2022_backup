<?php
include 'config.php';

session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
       header("Location: home.php");
       die();
}

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
       $row = mysqli_fetch_assoc($query);
}
?>








<!DOCTYPE html>
<html lang="en">


<head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>POC Share Wheels - Car Rental Website</title>
       <link rel="stylesheet" href="style.css">
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
       <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
       <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;900&display=swap" rel="stylesheet">
       <script src="https://kit.fontawesome.com/d6dc7c8001.js" crossorigin="anonymous"></script>
</head>
<style>
       h1 {
              font-size: 46px;
              font-weight: 800;
              margin: 15px 0;
              line-height: 50px;
              text-transform: uppercase;
              color: #24f8c7;
       }
</style>

<body>
       <section class="sub-header">
              <nav>
                     <a href="home.php" class="logo">
                            <i class="fa-solid fa-car-side"></i> POC Share Wheels
                     </a>
                     <div class="nav-links" id="navLinks">
                            <!-- Reposnive bar open and close -->
                            <i class="fa fa-times" onclick="hideMenu()"></i>
                            <ul>
                                   <li><a href="welcome.php">Home</a></li>
                                   <li><a href="about.php">Over Ons</a></li>
                                   <li><a href="poc-products.php">Producten</a></li>
                                   <li style="display: none;"><a href="#">Reserveren</a></li>
                                   <div class="dropdown">
                                          <li><a href="#">Account</a></li>
                                          <div class="dropdown-content">
                                                 <div class="user-info">
                                                        <?php echo "Welcome, "  . $row['naam']; ?>
                                                 </div>
                                                   <a>
                                                    <button id="openModalBtn" class="notify-icon-button" onclick="openModal()">
                                                     <span>Berichten</span>
                                                     <span class="notify-icon_badge">0</span>
                                                    </button>
                                                   </a>
                                                 <a href="profile.php">Profiel</a>
                                                 <a href="logout.php">Uitloggen</a>
                                          </div>
                                   </div>
                                   <li><a href="contact-page.php">Contact</a></li>

                            </ul>
                     </div>
                     <i class="fa fa-bars" onclick="showMenu()"></i>
                     <!-- Reposnive bar open and close -->
              </nav>
              <h1>Over Ons</h1>
       </section>
       <!-- Hierin vertel ik een klein stukje over wat doen als bedrijf. Hier onder lees je onze producten en diensten. !-->
       <section class="about-us">
              <div class="row">
                     <div class="about-col">
                            <h1>Wij zijn een van de meest ontwikkelde autobedrijven ooit</h1>
                            <p>POC Share Wheels is een autohuurbedrijf dat opgericht is in 2003.
                                   Sindsdien is ons bedrijf exponentieel gegroeid. Wij brengen de toekomst van huren op.
                                   Wij verhuren verschillende auto's zoals : personenauto's, bestelwagens,sportauto's etc.
                                   Bij POC Share Wheels zorgen dat elke klant hoge verwachtingen achterlaten voor ons. Wij leveren
                                   en verhuren tegen een lage prijs. Wij vechten voor de beste service en werken samen met de grootste
                                   autohuurbedrijven van Nederland.
                            </p>
                            <a href="about.php" class="hero_btn-8">ONTDEK MEER</a>
                     </div>
                     <div class="about-col">
                            <img src="images/about.png" alt="">
                     </div>
              </div>
              <div class="PageBlock">
                     <div class="verticalLine"></div>
                     <div class="Clear"></div>
              </div>
              <div class="row">

                     <!-- Hierin vertel een klein stukje over wat voor auto's wij leveren. -->
                     <div class="about-col">
                            <h1>Personenauto's</h1>
                            <p>POC Share Wheels biedt een wijd assortiment personenauto's. Hier bij POC
                                   Share Wheels krijg je goede, kwaliteit en mooie personenauto's voor een scherpe lage prijs.
                                   Wij bieden auto in elke maat en vorm. Wilt u bijvoorbeeld een personenauto dat elektrisch is?
                                   Dat hebben we. Wilt u er een voor de grote familie? POC Share Wheels heeft het allemaal.
                            </p>
                     </div>
                     <div class="about-col">
                            <img src="images/person-car_2.jpg" alt="">
                     </div>
                     <div class="PageBlock">
                            <div class="verticalLine"></div>
                            <div class="Clear"></div>
                     </div>
                     <div class="row">
                            <h1>Bestelwagens</h1>
                            <p>Hier zijn wat bestelwagens die wij bieden bij POC Share Wheels.</p>
                            <div class="course-col">
                                   <img src="images/delivery-cars.jpg" class="icon-4">
                                   <h3>Mercedes & Volkswagen</h3>
                                   <p>Kiest u de beste bestelwagens? Bij POC Share Wheels verhuren wij
                                          bestelwagens van Mercedes & Volkswagen. Lekker groot, compact en ideal voor een reis.
                                   </p>
                            </div>
                            <div class="course-col">
                                   <img src="images/delivery-cars3.jpg" class="icon-5">
                                   <h3>Opel & Ford</h3>
                                   <p>Kiest u de beste luxe bestelwagens? Bij POC Share Wheels verhuren wij
                                          bestelwagens van Opel & Ford. Erg comfortable, veel ruimte en luxe.
                                   </p>
                            </div>
                            <div class="course-col">
                                   <img src="images/delivery-cars2.webp" class="icon-6">
                                   <h3>Peugot & Toyota</h3>
                                   <p>Kiest u de grootste bestelwagens? Bij POC Share Wheels verhuren wij
                                          bestelwagens van Peugot & Toyota. Lekker groot, veel ruimte en geschikt voor elk type taak.
                                   </p>
                            </div>
                     </div>

                     <div class="PageBlock">
                            <div class="verticalLine"></div>
                            <div class="Clear"></div>
                     </div>
                     <div class="row">
                            <h1>Luxe auto's</h1>
                            <p>Hier zijn wat luxe auto's die wij bieden bij POC Share Wheels.</p>
                            <div class="course-col">
                                   <img src="images/porsche_911.jpeg" class="icon-7">
                                   <h3>Porsche & Lamborghini</h3>
                                   <p>Kiest u een van de snelste luxe sportauto? Bij POC Share Wheels verhuren wij
                                          luxe auto's van Porsche & Lamborghini. Snel, Elegant en Zakelijk.
                                   </p>
                            </div>
                            <div class="course-col">
                                   <img src="images/aston-martin-db11.jpg" class="icon-8">
                                   <h3>Aston Martin & Corvette </h3>
                                   <p>Kiest u de beste luxe sportauto? Bij POC Share Wheels verhuren wij
                                          auto's van Aston Martin & Corvette. Luxe voor het prijsje bij POC Share Wheels.
                                   </p>
                            </div>
                            <div class="course-col">
                                   <img src="images/rolls-royce-phantom-.jpg" class="icon-9">
                                   <h3>Rolls Royce & Bentley</h3>
                                   <p>Kiest u de grootste sportauto's? Bij POC Share Wheels verhuren wij
                                          sportauto's van Rolls Royce & Bentley. Lekker groot, veel ruimte en geschikt voor elk type taak.
                                   </p>
                            </div>
                            <div class="PageBlock">
                                   <div class="verticalLine"></div>
                                   <div class="Clear"></div>
                            </div>

                            <div class="row">
                                   <div class="about-col">
                                          <h1>Prijzen en Voorwaarden bij POC Share Wheels</h1>
                                          <p class="lease-text-area"> POC Share Wheels is geen perfecte functioneerde site zonder onze prijzen
                                                 en voorwaarden. <br> Wij leasen en verhuren auto's tegen een lage prijs. Wij geven veel om onze klanten en
                                                 we zorgen dat elke klant tevreden is over zijn/haar aankoop.
                                          <p>1 : De prijzen verschillen per auto bij POC Share Wheels.<br>
                                                 2 : Bij POC Share Wheels kunt u altijd een contract aanvragen om nogmaals per maand te betalen. <br>
                                                 3 : Voor iedere opdracht die wij in behandeling nemen maken wij de kosten.<br>
                                                 4 : Elke tarief bij POC Share Wheels wordt gerekend met hele uren.
                                          </p>
                                   </div>
                                   <div class="about-col">
                                          <img src="images/price-car.png" alt="" class="pricing-car">
                                   </div>
                            </div>

                            <div class="PageBlock">
                                   <div class="verticalLine"></div>
                                   <div class="Clear"></div>
                            </div>
                            <h1 class="renting-title_text">Huren met POC Share Wheels</h1>
                            <p>Hier kunt u lezen hoe bij ons huren en leasen werkt.</p>
                            <div class="course-col">
                                   <img src="images/step-1_icon.png" class="icon-10">
                                   <h3>Stap 1</h3>
                                   <p>Bij Stap 1 kunt u kiezen welke personenauto, bestelwagen of sportauto u wilt huren bij POC Share Wheels.
                                          Check voor meer op onze producten pagina.
                                          <br>
                                          <p class="about-highlight-text">Tip : Als je klant bent van POC Share Wheels kun je makkelijk gebruik gebruiken
                                                 van onze autozoeker, lekker eenvoudig en simpel.
                                                 </br>
                                          </p>
                                   </p>
                            </div>
                            <div class="course-col">
                                   <img src="images/step-2_icon.png" class="icon-11">
                                   <h3>Stap 2</h3>
                                   <p>Stap 2 is het regelen van uw gegevens en welke auto u gekozen heeft.
                                          Heeft u vragen over het huren van onze auto's? Neem gerust contact met ons op.
                                   </p>
                            </div>
                            <div class="course-col">
                                   <img src="images/step-3_icon.png" class="icon-12">
                                   <h3>Stap 3</h3>
                                   <p>Stap 3 is de laatste stap van het proces. Hier wordt alles geregeld. Van uw gegevens, uw huuraankoop
                                          tot aan de laatste details. Vragen er over? Neem gerust contact met ons op.
                                   </p>
                            </div>
       </section>
       <!-- Call to Action Start -->

       <section class="cta">
              <h1>GET READY FOR CONTACT</h1>
              <h4>Heeft u meer vragen over onze producten, prijzen en voorwaarden? <br> Neem gerust contact met ons op.</h4>
              <a href="contact-form.php" class="hero_btn-contact">CONTACT US</a>
       </section>
       <!-- Call to Action End -->

       <!-- Footer Section Start -->

       <body>
              <div class="container my-5">

                     <footer class="text-center text-lg-start text-white" style="background-color: #000; border-radius: 25px;">

                            <section class="d-flex justify-content-between p-4" style="background-color: #777">
                                   <div class="me-5">
                                          <span>Volg ons op onze sociale media:</span>
                                   </div>
                                   <div>
                                          <a href="https://www.facebook.com/" class="text-white me-4">
                                                 <i class="fa-brands fa-facebook-f"></i>
                                          </a>
                                          <a href="https://www.twitter.com/" class="text-white me-4">
                                                 <i class="fab fa-twitter"></i>
                                          </a>
                                          <a href="https://www.instagram.com/" class="text-white me-4">
                                                 <i class="fab fa-instagram"></i>
                                          </a>
                                          <a href="https://www.linkedin.com/feed/" class="text-white me-4">
                                                 <i class="fab fa-linkedin"></i>
                                          </a>
                                   </div>
                            </section>

                            <section class="">
                                   <div class="container text-center text-md-start mt-5">
                                          <!-- Grid row -->
                                          <div class="row mt-3">
                                                 <!-- Grid column -->
                                                 <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                                                        <!-- Content -->
                                                        <h6 class="text-uppercase fw-bold">POC Share Wheels</h6>
                                                        <h6>
                                                               Bij POC Share Wheels bieden wij de toekomst van auto's huren.
                                                               Altijd alles tegen een scherpe lage prijs, zeer goede kwaliteit.
                                                               De toekomst van huren. POC Share Wheels.
                                                        </h6>
                                                 </div>
                                                 <!-- Grid column -->

                                                 <!-- Grid column -->
                                                 <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                                                        <!-- Links -->
                                                        <h6 class="text-uppercase fw-bold">Over Ons</h6>
                                                        <p>
                                                               <a href="about.php" class="text-white">Lease</a>
                                                        </p>
                                                        <p>
                                                               <a href="about.php" class="text-white">Levering en Service</a>
                                                        </p>
                                                        <p>
                                                               <a href="about.php" class="text-white">Prijzen en Voorwaarden</a>
                                                        </p>

                                                 </div>
                                                 <!-- Grid column -->

                                                 <!-- Grid column -->
                                                 <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                                                        <!-- Links -->
                                                        <h6 class="text-uppercase fw-bold">Producten</h6>
                                                        <p>
                                                               <a href="fleetpark-carproducts.php" class="text-white">Personenauto's</a>
                                                        </p>
                                                        <p>
                                                               <a href="fleetpark-vanproducts.php" class="text-white">Bestelwagens</a>
                                                        </p>
                                                        <p>
                                                               <a href="fleetpark-luxuryproducts.php" class="text-white">Sportauto's</a>
                                                        </p>
                                                 </div>
                                                 <!-- Grid column -->

                                                 <!-- Grid column -->
                                                 <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                                                        <!-- Links -->
                                                        <h6 class="text-uppercase fw-bold">Contact</h6>
                                                        <p style="color: #fff;"><i class="fas fa-home mr-3"></i> Apollolaan 1, 1076 NN, AM</p>
                                                        <p style="color: #fff; font-size: 14px;"><i class="fas fa-envelope mr-3"></i> infopocsharewheels@gmail.com</p>
                                                        <p style="color: #fff;"><i class="fas fa-phone mr-3"></i> +31 06 86 10 37 26</p>
                                                 </div>
                                                 <!-- Grid column -->

                                                 <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                                                        <!-- Links -->
                                                        <h6 class="text-uppercase fw-bold">Conacttijden</h6>
                                                        <h5>MA : 9:00 - 17:00</h5>
                                                        <h5>DI : 9:00 - 17:00</h5>
                                                        <h5>WO : 9:00 - 17:00</h5>
                                                        <h5>DO : 9:00 - 17:00</h5>
                                                        <h5>VR : 9:00 - 17:00</h5>
                                                        <h5>ZA : 9:00 - 12:00</h5>
                                                        <h5>ZO : 9:00 - 12:00</h5>
                                                 </div>
                                          </div>
                                          <!-- Grid row -->
                                   </div>
                                   <h2 class="copyright-text">&copy; POC Share Wheels. 2022 Rights Reserved. Version : 1.0.16.3</h2>
                            </section>

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
       </body>

       <!-- Footer Section End -->

       <script src="script.js"></script>
</body>

</html>