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



if (isset($_POST["finder-btn"])) {
  $main_category = mysqli_escape_string($conn, $_POST["main_category"]);
  $city = mysqli_escape_string($conn, $_POST["city"]);
  $start_time = mysqli_escape_string($conn, $_POST["start_time"]);
  $end_time = mysqli_escape_string($conn, $_POST["end_time"]);
  $check_in = mysqli_escape_string($conn, $_POST["check_in"]);
  $check_out = mysqli_escape_string($conn, $_POST["check_out"]);

  $sql =  "SELECT `main_category`, `city`, `start_time`, `end_time`, `check_in`, `check_out` FROM cars WHERE `main_category` = '{$main_category}' ";
  $result = mysqli_query($conn, $sql);

  if ($check_in > $check_out) {
    $msg = "<div class= 'info alert-danger' style='font-weight: bold; color:#c80000; font-size: 13px; margin-left: 30%; margin-right: 30%; margin-bottom: 15px; ';> ERROR, check-in datum mag niet later zijn dan de check-uit datum.</div>";
  } else {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM cars WHERE main_category='{$main_category}' AND city='{$city}'")) > 0) {
      header("Location: " . $main_category . "-results.php");
    } else {
      $msg = "<div class= 'info alert-danger' style='font-weight: bold; color:#c80000; font-size: 13px; margin-left: 35%; margin-right: 31%; margin-bottom: 15px; ';> ERROR, er zijn helaas geen resultaten teruggevonden.</div>";
    }
  }
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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<style>
  body {
    animation: fadeIn 3s;
  }
</style>

<body>

  <section class="header">
    <nav>
      <a href="welcome.php" class="logo">
        <i class="fa-solid fa-car-side"></i> POC Share Wheels
      </a>
      <div class="nav-links" id="navLinks">
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
              <!-- Move the "Berichten" button inside the account dropdown -->
              <button id="berichtenButton" onclick="openModal()">
                Berichten
                <span class="counter-circle" id="counter">0</span>
              </button>
              <a href="profile.php">Profiel</a>
              <a href="logout.php">Uitloggen</a>
              <!-- Move the "Berichten" button outside the account dropdown -->
              <!-- added + revamped notification box center !-->
            </div>
          </div>
          <li><a href="contact-page.php">Contact</a></li>
        </ul>
      </div>
      <i class="fa fa-bars" onclick="showMenu()"></i>
    </nav>
  </section>

  <!-- Modal HTML structure -->
  <div class="modal" id="berichtenModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Berichten</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Add content for your modal here -->
          <p class="messages-subtitle_text">U heeft <span id="modalCounter">0</span> nieuwe berichten ontvangen.</p>
          <!-- Add additional content as needed -->
        </div>

        <div class="modal-footer">
          <p>Huidige versie: 1.0.16.3</p>
          <p>u bent up-to-date.</p>
        </div>
      </div>
    </div>
  </div>


  <div class="text_box">
    <h2>GET IN TOUCH</h2>
    <p id="headtext">DISCOVER OUR CAR RENTALSHIP</p>
    <p class="text">POC Share Wheels zijn opgericht als een manier om duurzaam te rijden. <br>
      Het is efficent voor toegankelijke reguliere chauffeurs. "Wat mensen nodig <br> hebben,
      is regulier vervoer."</p>
    <a href="about.php" class="hero_btn">Visit Us Today</a>

  </div>


  <header class="page-header">
    <div class="site-content-wrap site-content-wrap_small">
      <h2 class="heading-1">Huren bij POC Share Wheels</h2>
      <div class="intro-text">
        <div class="markdown">
          <p>
            Huur met de beste voorwaarden en een scherpe prijs. Of
            je nou 1 dag, een weekend, een lang weekend een
            personenauto of bestelauto nodig hebt, Bij POC Share Wheels vind je
            altijd een auto die jou het beste geschikt is!
          </p>
        </div>
      </div>
    </div>
  </header>


  <div id="booking" class="section">
    <div class="content-blocks">
      <div>
        <div class="site-content-wrap">
          <div class="section-center">
            <div class="container" style="max-width: 1160px;">

              <div class="row">
                <div class="booking-form">
                  <section class="car-finder card car-finder_loaded">
                    <form action="" method="post" enctype="multipart/form-data">
                      <fieldset>
                        <div class="main-categories_toggle">
                          <legend class="visually-hidden">Voertuigtype</legend>
                          <div class="main-categories_toggle-btn" onclick="carFunction()">
                            <input type="radio" id="car" name="main_category" class="visually-hidden" value="car" required="">
                            <label for="car" class="image-lazyloaded">
                              <img width="176" height="72" src="car-products/car-type-car.png" class="lazy-img loaded" alt="Auto" loading="lazy">
                              <span>Auto</span>
                            </label>
                          </div>

                          <div class="main-categories_toggle-btn" onclick="vanFunction()">
                            <input type="radio" id="van" name="main_category" class="visually-hidden" value="van" required="">
                            <label for="van" class="image-lazyloaded" name="van">
                              <img width="184" height="76" src="car-products/car-type-van.png" class="lazy-img loaded" alt="bestelauto" loading="lazy">
                              <span>Bestelauto</span>
                            </label>
                          </div>

                          <div class="main-categories_toggle-btn" onclick="luxeFunction()">
                            <input type="radio" id="luxe-car" name="main_category" class="visually-hidden" value="luxe-car" required="">
                            <label for="luxe-car" class="image-lazyloaded">
                              <img width="150" height="85" src="car-products/porsche_taycan.png " class="lazy-img loaded" alt="luxe-car" loading="lazy">
                              <span>Luxe Auto</span>
                            </label>
                          </div>

                        </div>
                      </fieldset>

                  </section>
                  <div class="car-finder_content">
                    <div class="car-finder_title">
                      <p class="car-finder_heading">
                        Huur een
                        <span id="category-type-text">Auto</span>
                      </p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <input class="form-control" type="text" placeholder="Kies een stad, postcode of plaats" id="city" name="city" required="" />
                      <span class="form-label">Waar wil je ophalen?</span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <select class="form-control" id="start-time" name="start_time">
                        <option>9:00</option>
                        <option>10:00</option>
                        <option>11:00</option>
                        <option>12:00</option>
                        <option>13:00</option>
                        <option>14:00</option>
                        <option>15:00</option>
                        <option>16:00</option>
                        <option>17:00</option>
                      </select>
                      <span class="select-arrow"></span>
                      <span class="form-label">Ophaaltijd</span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <select class="form-control" id="end-time" name="end_time">
                        <option>9:00</option>
                        <option>10:00</option>
                        <option>11:00</option>
                        <option>12:00</option>
                        <option>13:00</option>
                        <option>14:00</option>
                        <option>15:00</option>
                        <option>16:00</option>
                        <option>17:00</option>
                      </select>
                      <span class="select-arrow"></span>
                      <span class="form-label">Inlevertijd</span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input class="form-control" type="date" id="check-in" name="check_in" required="" min="2023-04-07">
                      <span class="form-label">Check In</span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input class="form-control" type="date" required="" id="check-out" name="check_out" max="2024-06-30">
                      <span class="form-label">Check Uit</span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-btn">
                      <button type="submit" class="submit-btn" id="submit-btn" name="finder-btn" onclick="findCarButton()">Bekijk Auto's</button>
                    </div>
                  </div>
                  <?php echo $msg; ?>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Course Section Start-->
  <section class="course">
    <div class="PageBlock">
      <div class="verticalLine"></div>
      <div class="Clear"></div>
    </div>
    <h1 class="services_title">CHECK ONZE DIENSTEN <br> & ASSORTIMENT</h1>
    <p>Ontdek hier onze diensten/assortiment bij POC Share Wheels.</p>

    <div class="row">
      <div class="course-col">
        <img src="images/lease-icon.png" class="icon-lease">
        <h3 class="paragraph-headingtext-1">Lease</h3>
        <p class="paragraph-text-1">Lekker gemakkelijk, efficent en snel.
          Bij POC Share Wheels kunt u altijd een lease auto huren
          voor de beste tarief en prijs. Of u nu een personenauto,
          bestelauto of luxe huurt.</p>
        <a href="about.php" class="hero_btn-lease">Lees Meer</a>
      </div>
      <div class="course-col">
        <img src="images/car-service.png" class="icon-service">
        <h3>Levering en Service</h3>
        <p>Levering en Service gaat lekker soepel bij POC Share Wheels.
          Wij zorgen voor uitstekende levering en service is zo lekker snel geregeld.
        </p>
        <a href="about.php" class="hero_btn-service">Lees Meer</a>
      </div>
      <div class="course-col">
        <img src="images/car-price.png" class="icon-prijzen">
        <h3>Prijzen en Voorwaarden</h3>
        <p>Lage prijzen, vaste tarieven.
          Bij POC Share Wheels kunt u kiezen uit meerdere verschillende auto's,
          van normale auto's tot aan bestelwagens en eventueel vrachtauto's.
        </p>
        <a href="about.php" class="hero_btn-prijzen">Lees Meer</a>
      </div>
    </div>
  </section>
  <!-- Course Section End-->

  <!-- Campus Section Start-->
  <section class="campus">
    <div class="PageBlock">
      <div class="verticalLine"></div>
      <div class="Clear"></div>
    </div>
    <h1 class="products_title">ONZE PRODUCTEN</h1>
    <p>Bij POC Share Wheels bieden wij uit ruime keuzes uit: Personenauto's, Bestelwagens's & Sportauto's.</p>

    <div class="row">
      <div class="campus-col">
        <img src="images/persons-car.jpg" alt="" class="i-1">
        <div class="layer-1">
          <h3>Personenauto's</h3>
        </div>
        <a href="fleetpark-carproducts.php" class="hero_btn-cars">Check Het Assortiment</a>

      </div>
      <div class="campus-col">
        <img src="images/delivery-cars.jpg" alt="" class="i-2">
        <div class="layer-2">
          <h3>Bestelwagens</h3>
        </div>
        <a href="fleetpark-vanproducts.php" class="hero_btn-vans">Check Het Assortiment</a>
      </div>
      <div class="campus-col">
        <img src="images/hyper-car.png" alt="" class="i-3">
        <div class="layer-3">
          <h3>Sportauto's</h3>
        </div>
        <a href="fleetpark-luxuryproducts.php" class="hero_btn-luxury-cars">Check Het Assortiment</a>
      </div>
    </div>
  </section>
  <!-- Campus Section End-->

  <!-- Package Plan Section Start !-->

  <!-- Hier komt binnenkort een nieuwe feature van POC Share Wheels : Het pakketplan. Hierin kunnen mensen hun autopakketplan kiezen etc.-->

  <!-- Note : if feature comes to new update, next things to implement are :
            1 : make an update banner if new features are coming for the site.
            2 : change version names.
            3 : next update : 1.0.16.3 -> 1.0.30.0

      Note : if featured are updated and fixed to the site start implementing next features :
            1 : adding dark mode theme 
            2 : fixing and improving stability
            3 : update version names.
            4 : future update : 1.0.30.0 -> 1.0.31.0
          
  !-->

  <section class="package-plan">
    <div class="container">
      <div class="pageblock">
        <div class="verticalLine"></div>
        <div class="Clear"></div>
      </div>
      <h3 class="package-plan_title">HET PAKKETPLAN</h3>
      <p class="package-plan_paragraph-text">Binnenkort gaan wij ons nieuwste feature introduceren bij POC Share Wheels: Het pakketplan!
        <br>Met deze nieuwe feature krijgen onze klanten kortingen op de nieuwste producten,
        <br>exclusieve features en nog veel meer!
      </p>
      <p class="package-plan_text">Stay tuned voor de nieuwe update!</p>
  </section>

  <!-- Package Plan Section End !-->


  <!-- Reviews Section Start -->

  <section class="reviews">
    <div class="PageBlock">
      <div class="verticalLine"></div>
      <div class="Clear"></div>
    </div>
    <h1 class="customers_title">WAT DE KLANTEN ZEGGEN OVER ONS</h1>
    <p>Hier delen onze klanten reviews over het bedrijf POC Share Wheels zelf. Bekijk wat de klanten over ons zeggen.</p>

    <div class="row">
      <div class="reviews-col">
        <img src="images/user.png" alt="oo..">
        <div>
          <p>Ik heb zo laatst een auto gehuurd op deze site en de service was geweldig.
            Mijn vrouw raadde me aan om deze site genaamd POC Share Wheels te bezoeken.
            Ze leverden een goede car-service, lage prijzen + een wijd genoeg assortiment te kiezen.</p>
          <h3>Tim Van Dijk</h3>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
        </div>
      </div>
      <div class="reviews-col">
        <img src="images/user-2.png" alt="oo..">
        <div>
          <p>Ik heb zo laatst een auto gehuurd op deze site en de service was geweldig.
            Mijn experince was geweldig op deze site. Alles was helder, duidelijk, overzichtelijk
            en leuk assortiment uit te kiezen. Klein minpuntje was het contacteren, het heeft wat langer geduurd dan
            normaal. Maar voor de rest een leuke site om te bezoeken.</p>
          <h3>Anne Hof</h3>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
        </div>
      </div>
      <div class="row">
        <div class="reviews-col">
          <img src="images/user-3.png" alt="oo..">
          <div>
            <p>Ik heb zo laatst een auto gehuurd op deze site en de service was geweldig.
              Mijn vrouw raadde me aan om deze site genaamd POC Share Wheels te bezoeken.
              Ze leverden een goede car-service, lage prijzen + een wijd genoeg assortiment te kiezen.
              Ik zou deze site zeker aanraden!</p>
            <h3>Pim Hoekstra</h3>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-alt"></i>
          </div>
        </div>
        <div class="reviews-col">
          <img src="images/user-4.png" alt="oo..">
          <div>
            <p>Ik heb zo laatst een auto gehuurd op deze site en de service was geweldig.
              Mijn vrouw raadde me aan om deze site genaamd POC Share Wheels te bezoeken.
              Ze leverden een goede car-service, lage prijzen + een wijd genoeg assortiment te kiezen.
              Ik zou deze site zeker aanraden!</p>
            <h3>Anne Letra</h3>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-alt"></i>
          </div>

  </section>

  <!-- Reviews Section End -->
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

      <footer class="text-center text-lg-start text-white" style="background-color: #000; border-radius: 20px;">

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
            <a href="https://www.linkedin.com/in/mike-koue-lambou-621272220/" class="text-white me-4">
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
  <script>
    function autocomplete(inp, arr) {

      var currentFocus;

      inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;

        closeAllLists();
        if (!val) {
          return false;
        }
        currentFocus = -1;

        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");

        this.parentNode.appendChild(a);

        for (i = 0; i < arr.length; i++) {

          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

            b = document.createElement("DIV");

            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(val.length);

            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
            });
            a.appendChild(b);
          }
        }
      });
      /*execute a function presses a key on the keyboard:*/
      inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {

          currentFocus++;

          addActive(x);
        } else if (e.keyCode == 38) { //up

          currentFocus--;

          addActive(x);
        } else if (e.keyCode == 13) {

          e.preventDefault();
          if (currentFocus > -1) {

            if (x) x[currentFocus].click();
          }
        }
      });

      function addActive(x) {

        if (!x) return false;
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);

        x[currentFocus].classList.add("autocomplete-active");
      }

      function removeActive(x) {

        for (var i = 0; i < x.length; i++) {
          x[i].classList.remove("autocomplete-active");
        }
      }

      function closeAllLists(elmnt) {

        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
          if (elmnt != x[i] && elmnt != inp) {
            x[i].parentNode.removeChild(x[i]);
          }
        }
      }

      document.addEventListener("click", function(e) {
        closeAllLists(e.target);
      });
    }


    var cities = ["Amsterdam-Noord", "Amsterdam-West", "Amsterdam-Oost", "Amsterdam Zuid (RAI) ", "Amsterdam Zuid", "Amsterdam Schiphol Airport",
      "Utrecht", "Den Haag", "Maastricht", "Amstelveen", "Rotterdam", "Leiden"
    ];


    autocomplete(document.getElementById("city"), cities);
  </script>

  <script src="script.js"></script>
  <script src="notify-box-settings.js"></script>


</body>

</html>