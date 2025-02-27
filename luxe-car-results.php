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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>POC Share Wheels - Luxe Car Results</title>
  <link rel="stylesheet" href="product_results.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC++EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;900&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/d6dc7c8001.js" crossorigin="anonymous"></script>
</head>
<style>
  .heading-products-text {
    font-size: 46px;
    font-weight: 800;
    margin: 15px 0;
    line-height: 50px;
    text-transform: uppercase;
    color: #24f8c7;
  }

  a {
    text-decoration: none;
    color: inherit;
  }
</style>

<body>
  <section class="sub-header">
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
            </div>
          </div>
          <li><a href="contact-page.php">Contact</a></li>
        </ul>
      </div>
      <i class="fa fa-bars" onclick="showMenu()"></i>
    </nav>
    <h1 class="heading-products-text">Resultaten</h1>
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

  <div class="car-finder-reults-page">
    <section class="car-finder-results">
      <div class="site-content-wrap">
        <div class="grid two-columns justify-content-center">
          <div class="grid-item one-third-column">
            <section class="vehicle-filters">
              <h2>
                <button type="button" class="vehicle-filters_modal-btn">
                  <div class="icon-filter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 19 16">
                      <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                    </svg>
                    Filters
                  </div>
                </button>
              </h2>

              <div class="vehicle-filters_active-filters-heading">
                <h2>
                  Filters
                  <span class="vehicle-filters_active-filter-count" id="vehicle-filter-count-luxury" value="0">0</span>
                </h2>
                <button class="vehicle-filters_reset-btn" id="vehicle_reset_btn"> Verwijder filters </button>
              </div>

              <div class="vehicle-filters_modal" id="filters-modal">
                <header class="vehicle-filters_modal-header">
                  <div class="icon-filter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 19 16">
                      <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                      Filters
                    </svg>
                  </div>
                  <button type="button" class="vehicle-filters_close-btn">
                    <div class="icon-close">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                      </svg>
                    </div>
                  </button>
                </header>

                <div class="vehicle-filters_groups">
                  <fieldset class="vehicle-filters_group">
                    <div>
                      <legend>Model</legend>
                    </div>
                    <div class="vehicle-filters_checkboxes">
                      <div class="checkbox-base checkbox-filter">
                        <input type="checkbox" id="checkbox-luxeauto" value="luxeauto" onclick="checkBoxLuxeCar()" />
                        <label for="checkbox-luxeauto">
                          <svg xmlns="http://www.w3.org/2000/svg" width="19" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 19 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                          </svg>
                          <span style="margin-bottom: 20px;">
                            Luxe auto (3)
                          </span>
                        </label>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </section>
          </div>

          <div class="grid-item two-thirds-column car-finder-results_results">
            <div class="car-finder-results_summary">
              <h2 class="car-finder-results_title">
                3
                <span> resultaten</span>
              </h2>
              <p class="car-finder-results_subtitle">
                <span>Alle prijzen zijn inclusief BTW</span>
              </p>
            </div>

            <div class="car-finder-results_list">
              <div id="results-ref">
                <section class="vehicle-result-list">
                  <ul class="vehicle-result-list_list">
                    <li class="vehicle-result-list_item"></li>
                    <li class="vehicle-result-list_item">
                      <div class="vehicle vehicle-result" id="PPLR">
                        <div>
                          <div class="card vehicle_card">
                            <div class="grid two-columns align-items-start">
                              <div class="grid-item">
                                <div class="vehicle-header">
                                  <h2 class="vehicle-header_title">
                                    Porsche 911 RS
                                    <span name="token-id">(PPLR)</span>
                                  </h2>
                                  <span class="vehicle-header_subtitle"> Of gelijkwaardig / Luxe auto</span>
                                </div>
                                <figure class="vehicle-image">
                                  <picture class="image-lazyloaded">
                                    <img width="353" height="199" src="car-products/porsche_panamera_turbo-s.png" class="lazy-img loaded" alt="personenauto" loading="lazy">
                                  </picture>
                                </figure>
                                <div class="vehicle_image-actions text-center"></div>
                              </div>
                              <div class="grid-item vehicle_card-features">
                                <div class="vehicle_features">
                                  <p class="vehicle_feature">
                                    <strong> 200 vrije km </strong>
                                    <span> / € 1,50 per extra km </span>
                                  </p>
                                  <p class="vehicle_feature vehicle_extra"> Minimale leeftijd bestuurder 18 jaar </p>
                                  <p class="vehicle_feature vehicle_extra"> All-season banden op aanvraag </p>
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
                                          <p>Benzine</p>
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
                                          <p>Automaat</p>
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
                                          <p>4 zitplaatsen</p>
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
                                          <p>4 deuren</p>
                                        </div>
                                      </span>

                                    </li>

                                    <li class="icon-list_item">
                                      <span class="icon-list_item-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
                                          <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
                                          <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
                                        </svg>
                                      </span>

                                      <span class="icon-list_item-text">
                                        <div class="markdown">
                                          <p>315 km p/h</p>
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
                                <div class="vehicle_prices">
                                  <hr class="vehicle_divider">
                                  <div class="vehicle_pricing">
                                    <div class="vehicle_pricing-row">
                                      <span class="vehicle_pricing-day" id="pricing-product-day"> € 150,00 / dag </span>
                                      <span class="vehicle_pricing-total" id="pricing-product-total">
                                        <strong>€ 150,00</strong>
                                        totaal
                                      </span>
                                    </div>
                                  </div>
                                  <div class="notice notice_info">
                                    <strong> Let op | </strong>
                                    <div class="markdown">
                                      <p class="extra-info">Beschikabaarheid op aanvraag</p>
                                    </div>
                                  </div>

                                  <a class="btn btn-primary vehicle_cta" href="book-finder.php?main_category=luxe-car&token-id=PPLR">
                                    Reserveer deze auto
                                  </a>
                                  <div class="text-center">
                                    <a class="btn btn-transparent btn-icon vehicle_card-expander-btn" href="porsche-911.php">
                                      <span>Meer informatie</span>
                                      <svg class="icon-chevron-right" xmlns="http://www.w3.org/2000/svg" width="19" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 19 16">
                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                      </svg>
                                  </div>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>

                    <li class="vehicle-result-list_item">
                      <div class="vehicle vehicle-result" id="RPLR">
                        <div>
                          <div class="card vehicle_card">
                            <div class="grid two-columns align-items-start">
                              <div class="grid-item">
                                <div class="vehicle-header">
                                  <h2 class="vehicle-header_title">
                                    Rolls Royce Phantom CM
                                    <span name="token-id">(RPLR)</span>
                                  </h2>
                                  <span class="vehicle-header_subtitle"> Of gelijkwaardig / Luxe auto </span>
                                </div>
                                <figure class="vehicle-image">
                                  <picture class="image-lazyloaded">
                                    <img width="353" height="199" src="car-products/rolls_royce_phantom_cm.png" class="lazy-img loaded" alt="personenauto" loading="lazy">
                                  </picture>
                                </figure>
                                <div class="vehicle_image-actions text-center"></div>
                              </div>
                              <div class="grid-item vehicle_card-features">
                                <div class="vehicle_features">
                                  <p class="vehicle_feature">
                                    <strong> 250 vrije km </strong>
                                    <span> / € 2,50 per extra km </span>
                                  </p>
                                  <p class="vehicle_feature vehicle_extra"> Minimale leeftijd bestuurder 18 jaar </p>
                                  <p class="vehicle_feature vehicle_extra"> All-season banden op aanvraag </p>
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
                                          <p>Benzine</p>
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
                                          <p>Automaat</p>
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
                                          <p>2 zitplaatsen</p>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
                                          <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
                                          <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
                                        </svg>
                                      </span>

                                      <span class="icon-list_item-text">
                                        <div class="markdown">
                                          <p>250 km p/h</p>
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
                                <div class="vehicle_prices">
                                  <hr class="vehicle_divider">
                                  <div class="vehicle_pricing">
                                    <div class="vehicle_pricing-row">
                                      <span class="vehicle_pricing-day"> € 225,00 / dag </span>
                                      <span class="vehicle_pricing-total">
                                        <strong>€ 225,00</strong>
                                        totaal
                                      </span>
                                    </div>
                                  </div>
                                  <div class="notice notice_info">
                                    <strong> Let op | </strong>
                                    <div class="markdown">
                                      <p class="extra-info">Beschikabaarheid op aanvraag</p>
                                    </div>
                                  </div>

                                  <a class="btn btn-primary vehicle_cta" href="book-finder.php?main_category=luxe-car&token-id=RPLR">
                                    Reserveer deze auto
                                  </a>
                                  <div class="text-center">
                                    <a class="btn btn-transparent btn-icon vehicle_card-expander-btn" href="rolls-royce-phantom.php">
                                      <span>Meer informatie</span>
                                      <svg class="icon-chevron-right" xmlns="http://www.w3.org/2000/svg" width="19" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 19 16">
                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                      </svg>
                                  </div>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>

                    <li class="vehicle-result-list_item">
                      <div class="vehicle vehicle-result" id="CCLR">
                        <div>
                          <div class="card vehicle_card">
                            <div class="grid two-columns align-items-start">
                              <div class="grid-item">
                                <div class="vehicle-header">
                                  <h2 class="vehicle-header_title">
                                    Corvette C8
                                    <span name="token-id">(CCLR)</span>
                                  </h2>
                                  <span class="vehicle-header_subtitle"> Of gelijkwaardig / Luxe auto </span>
                                </div>
                                <figure class="vehicle-image">
                                  <picture class="image-lazyloaded">
                                    <img width="400" height="230" src="car-products/corvette_c8.png" class="lazy-img loaded" alt="luxe auto" loading="lazy">
                                  </picture>
                                </figure>
                                <div class="vehicle_image-actions text-center"></div>
                              </div>
                              <div class="grid-item vehicle_card-features">
                                <div class="vehicle_features">
                                  <p class="vehicle_feature">
                                    <strong> 300 vrije km </strong>
                                    <span> / € 3,00 per extra km </span>
                                  </p>
                                  <p class="vehicle_feature vehicle_extra"> Minimale leeftijd bestuurder 18 jaar </p>
                                  <p class="vehicle_feature vehicle_extra"> All-season banden op aanvraag </p>
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
                                          <p>Benzine</p>
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
                                          <p>Automaat</p>
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
                                          <p>5 zitplaatsen</p>
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
                                          <p>5 deuren</p>
                                        </div>
                                      </span>

                                    </li>

                                    <li class="icon-list_item">
                                      <span class="icon-list_item-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
                                          <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
                                          <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
                                        </svg>
                                      </span>

                                      <span class="icon-list_item-text">
                                        <div class="markdown">
                                          <p>315 km p/h</p>
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
                                <div class="vehicle_prices">
                                  <hr class="vehicle_divider">
                                  <div class="vehicle_pricing">
                                    <div class="vehicle_pricing-row">
                                      <span class="vehicle_pricing-day"> € 300,00 / dag </span>
                                      <span class="vehicle_pricing-total">
                                        <strong>€ 300,00</strong>
                                        totaal
                                      </span>
                                    </div>
                                  </div>
                                  <div class="notice notice_info">
                                    <strong> Let op | </strong>
                                    <div class="markdown">
                                      <p class="extra-info">Beschikabaarheid op aanvraag</p>
                                    </div>
                                  </div>

                                  <a class="btn btn-primary vehicle_cta" href="book-finder.php?main_category=luxe-car&token-id=CCLR">
                                    Reserveer deze auto
                                  </a>
                                  <div class="text-center">
                                    <a class="btn btn-transparent btn-icon vehicle_card-expander-btn" href="corvette-c8.php">
                                      <span>Meer informatie</span>
                                      <svg class="icon-chevron-right" xmlns="http://www.w3.org/2000/svg" width="19" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 19 16">
                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                      </svg>
                                  </div>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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

  <script src="script.js"></script>
  <script src="notify-box-settings.js"></script>
</body>

</html>