<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/fonts.css">
    <!-- <link rel="stylesheet" type="text/css" href="./css/style.css"> -->
    <link rel="stylesheet" type="text/css" href="./css/styleNew.css">
    <link rel="stylesheet" type="text/css" href="./css/newMenu.css">
    <link rel="stylesheet" type="text/css" href="./css/newMenuMobile.css">
    <!-- <link rel="stylesheet" type="text/css" href="./css/ipsum_form.css"> -->
    <script src="./js/menu.js" defer ></script>
    <title>Hotel Ipsum - {{document-title}}</title>
</head>
<body>
    <div class="headsection">
        <div id="navbar-mobile">
            <div class="logo-div mobile" title="Homepage">
                <a class="navbar-logo" href="./index">
                    <img class="logo-mobile" src="./images/Logo.png" />
                </a>
            </div>
            <div id="hamburger" title="Menü öffnen/schließen">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>

        <div id="slide-menu" class="closed">
            <ul>
                <li><a class="hoverLine" href="./index">Home</a></li>
                <li><a class="hoverLine" href="#">Book</a></li>
                <li><a class="hoverLine" href="./help">Help</a></li>
                <li><a class="hoverLine" class="active" href="./imprint">Imprint</a></li>
                <li><a class="hoverLine" href="#">Contact</a></li>
                <li>
                    <div class="account-logo-container">

                        <a href="./login" class="account-logo-large" title="Login">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                            <span class="hoverLine">{{menu-username}}</span>

                        </a>
                    </div>
                </li>
            </ul>
        </div>
        <div id="ipsum-navbar" class="container text-center">
            <div class="row">
                <div class="col-3">
                    <div class="logo-div">
                        <a class="navbar-logo" href="./index">
                            <img class="logo" src="./images/Logo.png" />
                        </a>
                    </div>
                </div>
                <div class="col-7" id="link-column">
                    <div id="link-wrapper">
                        <ul>
                            {{menu-links}}
                        </ul>
                    </div>
                </div>
                <div class="col-2">
                    <div class="account-logo-container">
                        <a href="./login" class="account-logo-large" title="Login">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                            <span class="hoverLine">{{menu-username}}</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row"></div>

        </div>
        <div class="carousel slide" id="navigation-carousel" data-bs-ride="true">
            <!-- <div class="carousel-indicators">
            <button type="button" data-bs-target="#navigation-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#navigation-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div> -->
            <div id="navbar-carousel" class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-image" style="background-image: url(./images/bg_2.jpeg) !important;"></div>
                    <!-- <img src="./images/bg_2.jpeg" class="d-block w-100" alt="..."> -->
                </div>
                <div class="carousel-item">
                    <div class="carousel-image" style="background-image: url(./images/bg_1.jpeg) !important;"></div>

                    <!-- <img src="./images/bg_1.jpeg" class="d-block w-100" alt="..."> -->
                </div>
            </div>
        </div>

    </div>
<!-- content -->
<section class="main-section">
    <h1 class="main-header">Imprint</h1>
    <div class="row">
        <div class="column">
            <h3>Ipsum Hotel GmbH</h3>
            <p>Lorem Ipsum Straße 69<br/>
            0420 Wien<br/>
            Österreich<br/><br/>
            Telefon: +43 1 234 56<br/>
            Mail: contact@ipsum.com<br/><br/>
            Geschäftsführer: Markus Rösner, Maximilian Sinnl<br/>
            Handelsregister: Handelsgericht Wien, Marxergasse 1a, 1030 Wien<br/>
            USt-IdNr.: AT123456789<br/>
            </p>
        </div>

        <div class="column">
            <div class="imprint-images">
                <div class="imprint-image-div">
                    <img src="./images/markus.png" width="125rem" alt="Markus Rösner" />
                    <p class="imprint-image-name">Markus Rösner</p>
                </div>
        
                <div class="imprint-image-div">
                    <img src="./images/max.png" width="125rem" alt="Max Sinnl" />
                    <p class="imprint-image-name">Max Sinnl</p>
                </div>
            </div>
        </div>
    </div>

        


</section>

  
<footer></footer>
</body>
</html>