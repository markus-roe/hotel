<body>
    <div class="headsection {{menu-size}}">
        <div id="navbar-mobile">
            <div class="logo-div mobile" title="Homepage">
                <a class="navbar-logo" href="./home/index">
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
                {{menu-links}}
                <li>
                    <div class="account-logo-container">
                    
                        <a href="{{profilepath}}" class="account-logo-large" title="Login">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                            <span class="hoverLine">{{firstname}} {{surname}}</span>

                        </a>
                    </div>
                </li>
            </ul>
        </div>
        <div id="ipsum-navbar" class="container text-center">
            <div class="row">
                <div class="col-3">
                    <div class="logo-div">
                        <a class="navbar-logo" href="./home/index">
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
                        <a href="{{profilepath}}" class="account-logo-large" title="Login">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                            <span class="hoverLine">{{firstname}} {{surname}}</span>
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