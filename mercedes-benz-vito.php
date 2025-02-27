<?php

include 'config.php';
$msg = "";

session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
  header("Location: login.php");
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
  <link rel="stylesheet" href="info-cars.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;900&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/d6dc7c8001.js" crossorigin="anonymous"></script>
</head>
<style>
  .heading-text {
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
      <a href="welcome.php" class="logo">
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
          <li style="display: none;"><a href="login.php">Login</a></li>
          <li><a href="contact-page.php">Contact</a></li>

        </ul>
      </div>
      <i class="fa fa-bars" onclick="showMenu()"></i>
      <!-- Reposnive bar open and close -->
    </nav>
    <h1 class="heading-text">Informatie</h1>
  </section>

  <div class="fleet-detail-page">
    <div class="site-content-wrap">
      <div class="vehicle vehicle-detail">
        <div class="vehicle-header_page-header">
          <div class="vehicle-header">
            <h1 class="vehicle-header_title">
              Mercedes Benz Vito
              <span>(MBVN)</span>
            </h1>
            <span class="vehicle-header_subtitle"> Of gelijkwaardig / Bestelauto </span>
          </div>
        </div>
        <div class="grid two-columms">
          <div class="grid-item three-fifth-column">
            <figure class="vehicle-image">
              <picture>
                <img width="696" height="348" src="car-products/mercedes_benz_vito.png" alt="mercedes-benz-vito">
              </picture>
            </figure>
            <div class="vehicle_image-actions text-center"></div>
          </div>
          <div class="grid-item two-fifth-columm">
            <div class="vehicle_features">
              <div class="vehicle_feature">
                <p class="vehicle_feature vehicle_extra"> Minimale leeftijd bestuurder 21 jaar </p>
                <p class="vehicle_feature vehicle_extra"> Trekhaak en all-season banden op aanvraag </p>
                <ul class="icon-list">
                  <li class="icon-list_item">
                    <span class="icon-list_item-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="19" height="16" fill="currentColor" class="bi bi-fuel-pump" viewBox="0 0 19 16">
                        <path d="M3 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-5Z" />
                        <path d="M1 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v8a2 2 0 0 1 2 2v.5a.5.5 0 0 0 1 0V8h-.5a.5.5 0 0 1-.5-.5V4.375a.5.5 0 0 1 .5-.5h1.495c-.011-.476-.053-.894-.201-1.222a.97.97 0 0 0-.394-.458c-.184-.11-.464-.195-.9-.195a.5.5 0 0 1 0-1c.564 0 1.034.11 1.412.336.383.228.634.551.794.907.295.655.294 1.465.294 2.081v3.175a.5.5 0 0 1-.5.501H15v4.5a1.5 1.5 0 0 1-3 0V12a1 1 0 0 0-1-1v4h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V2Zm9 0a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v13h8V2Z" />
                      </svg>
                    </span>

                    <span class="icon-list_item-text">
                      <div class="markdown">
                        <p>Diesel</p>
                      </div>
                    </span>

                  </li>

                  <li class="icon-list_item">
                    <span class="icon-list_item-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-manual-gearbox" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="5" cy="6" r="2" />
                        <circle cx="12" cy="6" r="2" />
                        <circle cx="19" cy="6" r="2" />
                        <circle cx="5" cy="18" r="2" />
                        <circle cx="12" cy="18" r="2" />
                        <line x1="5" y1="8" x2="5" y2="16" />
                        <line x1="12" y1="8" x2="12" y2="16" />
                        <path d="M19 8v2a2 2 0 0 1 -2 2h-12" />
                      </svg>
                    </span>

                    <span class="icon-list_item-text">
                      <div class="markdown">
                        <p>Handgeschakeld</p>
                      </div>
                    </span>

                  </li>

                  <li class="icon-list_item">
                    <span class="icon-list_item-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="19" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 19 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                      </svg>
                    </span>

                    <span class="icon-list_item-text">
                      <div class="markdown">
                        <p>3 zitplaatsen</p>
                      </div>
                    </span>

                  </li>

                  <li class="icon-list_item">
                    <span class="icon-list_item-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="19" height="16" fill="currentColor" class="bi bi-door-closed-fill" viewBox="0 0 19 16">
                        <path d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1h8zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                      </svg>
                    </span>

                    <span class="icon-list_item-text">
                      <div class="markdown">
                        <p>2 deuren</p>
                      </div>
                    </span>

                  </li>

                  <li class="icon-list_item">
                    <span class="icon-list_item-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M510.3 445.9L437.3 153.8C433.5 138.5 420.8 128 406.4 128H346.1c3.625-9.1 5.875-20.75 5.875-32c0-53-42.1-96-96-96S159.1 43 159.1 96c0 11.25 2.25 22 5.875 32H105.6c-14.38 0-27.13 10.5-30.88 25.75l-73.01 292.1C-6.641 479.1 16.36 512 47.99 512h416C495.6 512 518.6 479.1 510.3 445.9zM256 128C238.4 128 223.1 113.6 223.1 96S238.4 64 256 64c17.63 0 32 14.38 32 32S273.6 128 256 128z" />
                      </svg>
                    </span>

                    <span class="icon-list_item-text">
                      <div class="markdown">
                        <p>660 kg laadverm.</p>
                      </div>
                    </span>
                  </li>

                  <li class="icon-list_item">
                    <span class="icon-list_item-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="19" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 19 16">
                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                      </svg>
                    </span>

                    <span class="icon-list_item-text">
                      <div class="markdown">
                        <p>18 m³ inhoud.</p>
                      </div>
                    </span>
                  </li>

                  <li class="icon-list_item">
                    <span class="icon-list_item-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                        <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
                        <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
                      </svg>
                    </span>

                    <span class="icon-list_item-text">
                      <div class="markdown">
                        <p>Rijbewijs B</p>
                      </div>
                    </span>
                  </li>

                  <li class="icon-list_item">
                    <span class="icon-list_item-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-snow" viewBox="0 0 16 16">
                        <path d="M8 16a.5.5 0 0 1-.5-.5v-1.293l-.646.647a.5.5 0 0 1-.707-.708L7.5 12.793V8.866l-3.4 1.963-.496 1.85a.5.5 0 1 1-.966-.26l.237-.882-1.12.646a.5.5 0 0 1-.5-.866l1.12-.646-.884-.237a.5.5 0 1 1 .26-.966l1.848.495L7 8 3.6 6.037l-1.85.495a.5.5 0 0 1-.258-.966l.883-.237-1.12-.646a.5.5 0 1 1 .5-.866l1.12.646-.237-.883a.5.5 0 1 1 .966-.258l.495 1.849L7.5 7.134V3.207L6.147 1.854a.5.5 0 1 1 .707-.708l.646.647V.5a.5.5 0 1 1 1 0v1.293l.647-.647a.5.5 0 1 1 .707.708L8.5 3.207v3.927l3.4-1.963.496-1.85a.5.5 0 1 1 .966.26l-.236.882 1.12-.646a.5.5 0 0 1 .5.866l-1.12.646.883.237a.5.5 0 1 1-.26.966l-1.848-.495L9 8l3.4 1.963 1.849-.495a.5.5 0 0 1 .259.966l-.883.237 1.12.646a.5.5 0 0 1-.5.866l-1.12-.646.236.883a.5.5 0 1 1-.966.258l-.495-1.849-3.4-1.963v3.927l1.353 1.353a.5.5 0 0 1-.707.708l-.647-.647V15.5a.5.5 0 0 1-.5.5z" />
                      </svg>
                    </span>

                    <span class="icon-list_item-text">
                      <div class="markdown">
                        <p>Airco</p>
                      </div>
                    </span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="vehicle_prices">
              <a class="btn btn-primary vehicle_cta" href="book-finder.php?main_category=van&token-id=MBVN">
                Reserveer deze auto
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="cta">
    <h1>GET READY FOR CONTACT</h1>
    <h4>Heeft u meer vragen over onze producten, prijzen en voorwaarden? <br> Neem gerust contact met ons op.</h4>
    <a href="contact-page.php" class="hero_btn-contact">CONTACT US</a>
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
</body>


<script src="script.js"></script>

</html>