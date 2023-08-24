<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-left">
            <h1 class="Poiret">edge.</h1>
            <div class="nav-list-container">
                <ul class="nav-list ">
                    <li><a href="<?php if ($_SERVER['REQUEST_URI'] == "/MedicalLabratory/" || $_SERVER['REQUEST_URI'] == "/MedicalLabratory/index.php") {
                                        echo "#hom";
                                    } else {
                                        echo "./#hom";
                                    } ?>"> Home</a></li>
                    <li><a href="<?php if ($_SERVER['REQUEST_URI'] == "/MedicalLabratory/" || $_SERVER['REQUEST_URI'] == "/MedicalLabratory/index.php") {
                                        echo "#abt";
                                    } else {
                                        echo "./#abt";
                                    } ?>">About</a></li>
                    <li><a href="<?php if ($_SERVER['REQUEST_URI'] == "/MedicalLabratory/" || $_SERVER['REQUEST_URI'] == "/MedicalLabratory/index.php") {
                                        echo "#srvs";
                                    } else {
                                        echo "./#srvs";
                                    } ?>">Services</a></li>
                    <li><a href="<?php if ($_SERVER['REQUEST_URI'] == "/MedicalLabratory/" || $_SERVER['REQUEST_URI'] == "/MedicalLabratory/index.php") {
                                        echo "#pri";
                                    } else {
                                        echo "./#pri";
                                    } ?>">Pricing</a></li>
                    <li><a href="<?php if ($_SERVER['REQUEST_URI'] == "/MedicalLabratory/" || $_SERVER['REQUEST_URI'] == "/MedicalLabratory/index.php") {
                                        echo "#us";
                                    } else {
                                        echo "./#us";
                                    } ?>">Make an Appointment</a></li>
                </ul>
            </div>
        </div>
        <div class="navbar-right__actions ">
            <div class="navbar-right">
                @if(!session('mrn'))
             
                    <a class="btn sign-in" href="{{ route('login') }}">Sign In</a>
                    <a class="btn sign-up" href="{{ route('signup') }}">Sign Up</a>
                @else
                    <a class="btn sign-in" href="{{ route('logout') }}">Logout</a>
                    @if(request()->is('/') || request()->is('index.php'))
                        <a class="account-btn" href="{{ route('profile') }}">
                            <img src="{{ asset('assets/icons8-user-24.png') }}" alt="">
                        </a>
                    @endif
                    <!-- <a class="account-btn" href="{{ route('profile') }}">
                            <img src="{{ asset('assets/icons8-user-24.png') }}" alt="">
                        </a> -->
                @endif
            </div>
            
        </div>
        <div class="navbar-right ">
            <div class="navbar-btn ">
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>
    </div>
    <div class="navbar-mobile ">
        <ul class="navbar-mobile__list hidden" id="list-mobile">
            <li><a href="#hom"> Home</a></li>
            <li><a href="#abt">About</a></li>
            <li><a href="#srvs">Services</a></li>
            <li><a href="#pri">Pricing</a></li>
            <li><a href="#us">Contact us</a></li>
        </ul>
        <div class="navbar-mobile__actions">
            <button class=" sign-in__mobile">Sign In</button>
            <button class=" sign-up__mobile">Sign Up</button>
        </div>
    </div>
</nav>

<script>
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>