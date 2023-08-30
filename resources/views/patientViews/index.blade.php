
@include('_patientBase')
<body>
    @include('components.navbar')

    <main>
        @if ($errors->any())
            @php
                echo "<script>alert('Please fill in all the appointment details correctly');</script>";
            @endphp
        @endif
        <section class="hero" id="hero">
            <div class="hero-img-container">
                <img class="hero-img" src={{asset("/assets/background.jpg")}} alt="" />
            </div>
            <div class="hero-content" id="hom">
                <div class="hero-text">
                    <h3>Edge Laboratories</h3>
                    <h1>Edge Laboratories is Specialized in Medical Tests and Research</h1>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et
                        consequuntur, reiciendis veniam pariatur tempora, rerum mollitia,
                        labore dolores suscipit est quae sequi voluptatibus necessitatibus
                        modi vero earum similique. Voluptas, adipisci!
                    </p>
                    <button class="btn btn-book">Learn More &DownArrow;</button>
                </div>

        </section>
        <section class="about" id=abt>
            <div class="about-container">
                <h1>
                    trusted by the egyptian ministry of health
                </h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam pariatur optio dolorem assumenda ea
                    tempore tempora doloribus provident cupiditate tenetur.</p>

                <div class="about-details">
                    <div class="about-details-item">
                        <h3>1000</h3>
                        <h3>CLIENTS</h3>
                    </div>
                    <div class="about-details-item">
                        <h3>305</h3>
                        <h3>STAFF</h3>
                    </div>
                    <div class="about-details-item">
                        <h3>50</h3>
                        <h3>EXPIERENCE</h3>
                    </div>
                    <div class="about-details-item">
                        <h3>640</h3>
                        <h3>SUPPLIERS</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="services" id="srvs">
            <div class="container">
                <div class="services-container">
                    <h3>Services</h3>
                    <h1>Our Core Services</h1>
                    <div class="services-box">
                        <div class="service">
                            <div class="service-left">
                                <div class="serivce-img-container">
                                    <img src={{asset("./assets/icons8-optical-microscope-64.png")}} alt="">
                                </div>
                            </div>
                            <div class="service-right">
                                <h3>Advanced Microscopy</h3>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, eum nesciunt saepe
                                    voluptates maiores quas?</p>
                            </div>
                        </div>
                        <div class="service">
                            <div>
                                <div class="serivce-img-container">
                                    <img src={{asset("./assets/icons8-biology-64.png")}} alt="">
                                </div>
                            </div>
                            <div>
                                <h3>Molecular Biology</h3>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, eum nesciunt saepe
                                    voluptates maiores quas?</p>
                            </div>
                        </div>
                        <div class="service">
                            <div>
                                <div class="serivce-img-container">
                                    <img src={{asset("./assets/icons8-diabetes-64.png")}} alt="">
                                </div>
                            </div>
                            <div>
                                <h3>Diabetes Testing</h3>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, eum nesciunt saepe
                                    voluptates maiores quas?</p>
                            </div>
                        </div>
                        <div class="service">
                            <div>
                                <div class="serivce-img-container">
                                    <img src={{asset("./assets/icons8-chemistry-64.png")}} alt="">
                                </div>
                            </div>
                            <div>
                                <h3>Chemical Research</h3>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, eum nesciunt saepe
                                    voluptates maiores quas?</p>
                            </div>
                        </div>
                        <div class="service">
                            <div>
                                <div class="serivce-img-container">
                                    <img src={{asset("./assets/icons8-lungs-64.png")}} alt="">
                                </div>
                            </div>
                            <div>
                                <h3>Anatomical Pathology</h3>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, eum nesciunt saepe
                                    voluptates maiores quas?</p>
                            </div>
                        </div>
                        <div class="service">
                            <div>
                                <div class="serivce-img-container">

                                    <img src={{asset("./assets/icons8-anatomy-64.png")}} alt="">
                                </div>
                            </div>
                            <div>
                                <h3>Heart Disease</h3>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea, eum nesciunt saepe
                                    voluptates maiores quas?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pricing" id="pri">
            <div class="container">
                <div class="pricing-container">
                    <h3>Pricing</h3>
                    <h1>The right price for your needs.</h1>

                    <div class="pricing-plan-container">
                        <div class="pricing-plan">
                            <span class="plan-type">Standard</span>
                            <div class="plan-content">
                                <p class="price">400 L.E <span class="price-span">/mo</span></p>
                                <h3>400 L.E for a Monthly Cheeckup Including The Following Medical Tests</h3>
                                <ul class="plan-list">
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span> Complete Blood
                                        Count
                                    </li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Liver Function Blood
                                        Test</li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Prothrombin Time
                                    </li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Hemoglobin A1C</li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Urinalysis</li>

                                    <li style="visibility: hidden;"> <span><img src={{asset("./assets/icons8-done-48.png")}}
                                                alt=""></span>Liver Function Blood Test</li>
                                    <li style="visibility: hidden;"> <span><img src={{asset("./assets/icons8-done-48.png")}}
                                                alt=""></span>Liver Function Blood Test</li>
                                    <li style="visibility: hidden;"> <span><img src={{asset("./assets/icons8-done-48.png")}}
                                                alt=""></span>Liver Function Blood Test</li>
                                    <li style="visibility: hidden;"> <span><img src={{asset("./assets/icons8-done-48.png")}}
                                                alt=""></span>Liver Function Blood Test</li>
                                </ul>
                                <!-- <button class="btn plan-actions">Get Started</button> -->
                            </div>
                        </div>
                        <div class="pricing-plan pricing-plan-premium">
                            <span class="plan-type">Premium</span>
                            <div class="plan-content">
                                <p class="price">1200 L.E <span class="price-span">/mo</span></p>
                                <h3>1200 L.E for a Monthly Cheeckup Including The Following Medical Tests</h3>
                                <ul class="plan-list">
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span> Complete Blood
                                        Count
                                    </li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Liver Function Blood
                                        Test</li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Prothrombin Time
                                    </li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Hemoglobin A1C</li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Urinalysis</li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Comprehensive
                                        Metabolic
                                    </li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Female General
                                        Health
                                        Panel</li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span> Transmitted
                                        Diaseases
                                    </li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Cholesterol Lipid
                                        Levels
                                    </li>
                                </ul>
                                <!-- <button class="btn plan-actions">Get Started</button> -->
                            </div>
                        </div>
                        <div class="pricing-plan">
                            <span class="plan-type">Gold</span>
                            <div class="plan-content">
                                <p class="price">800 L.E <span class="price-span">/mo</span></p>
                                <h3>800 L.E for a Monthly Cheeckup Including The Following Medical Tests</h3>
                                <ul class="plan-list">
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span> Complete Blood
                                        Count
                                    </li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Liver Function Blood
                                        Test</li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Prothrombin Time
                                    </li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Hemoglobin A1C</li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Urinalysis</li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Comprehensive
                                        Metabolic
                                    </li>
                                    <li> <span><img src={{asset("./assets/icons8-done-48.png")}} alt=""></span>Female General
                                        Health
                                        Panel</li>
                                    <li style="visibility: hidden;"> <span><img src={{asset("./assets/icons8-done-48.png")}}
                                                alt=""></span> Transmitted Diaseases</li>
                                    <li style="visibility: hidden;"> <span><img src={{asset("./assets/icons8-done-48.png")}}
                                                alt=""></span> Cholesterol Lipid Levels</li>

                                </ul>
                                <!-- <button class="btn plan-actions">Get Started</button> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="contact id=" id="us">
            <div class="contact-img-container">
                <img class="contact-img" src="./assets/background2.jpg" alt="" />
            </div>
            <div class="contact-content">
                <h1>Medical Tests Carried Out By Our Expert Lab Scientists</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis itaque facilis eveniet numquam
                    consequatur sed quam recusandae quos at dolorem.</p>
                <div class="contact-us-form-group">
                    <div class="contact-us-right-group">
                        <form action="{{route("makeAppointment")}}" method="POST" class="contact-form">
                            @csrf
                            <h1 class="appointment-header">Make an Appointment</h1>
                            {{-- @if (!empty($appointmentError))
                            <h3 class="input-error" id="form-error">
                                {{ $appointmentError }}
                            </h3>
                            @endif --}}
                            <ul class="contact-form-input">
                                <li>
                                    <input type="text" value="{{ isset($patient->username) ? $patient->username : '' }}"
                                           placeholder="Your name" name="username" {{ session()->has('mrn') ? 'disabled' : '' }}>
                                </li>
                                <li>
                                    <input type="email" value="{{ isset($patient->email) ? $patient->email : '' }}"
                                           placeholder="Your email" name="email" {{ session()->has('mrn') ? 'disabled' : '' }}>
                                </li>
                                
                                <li>
                                    <input type="text" placeholder="Your Phone Number" id="phone" name="phone">
                                
                                </li>
                                <li>
                                    <select class="select" name="selected">
                                        <option value="0">Test Type:</option>
                                        @foreach ($tests as $test)
                                        <option value="{{ $test->test_id }}">
                                            {{ $test->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </li>
                                <li>
                                    <input class="date" type="time" placeholder="time" name="time">
                                </li>
                                <li>
                                    <input class="date" id="date" type="date" placeholder="Date" name="date">
                                </li>
                            </ul>
                            <div class="contact-actions"></div>
                            <button class="btn btn-appointment btn-action-1" name="appointment" type="submit"
                                id="appointment-submit">make an appointment</button>
                        </form>
                    </div>
                    <div class="contact-us-left-group">
                        <div class="contacts-item">
                            <div class="contacts-item-left">
                                <img src="{{ asset('./assets/pin.png') }}" alt="">
                            </div>
                            <div class="contacts-item-right">
                                <h3>OUR ADDRESS</h3>
                                <p class="contact-address">
                                    2946 Angus Road, NY
                                </p>
                            </div>
                        </div>
                        <div class="contacts-item">
                            <div class="contacts-item-left">
                                <img src="{{ asset('./assets/telephone.png') }}" alt="">
                            </div>
                            <div class="contacts-item-right">
                                <h3>PHONE NUMBER</h3>
                                <p class="contact-number">
                                    +31 123 456 7890
                                </p>
                            </div>
                        </div>
                        <div class="contacts-item">
                            <div class="contacts-item-left">
                                <img src="{{ asset('./assets/mail.png') }}" alt="">
                            </div>
                            <div class="contacts-item-right">
                                <h3>EMAIL ADDRESS</h3>
                                <p class="contact-address">
                                    contact@edge.com
                                </p>
                            </div>
                        </div>
                        <div class="contacts-item">
                            <div class="contacts-item-left">
                                <img src="{{ asset('./assets/settings.png') }}" alt="">
                            </div>
                            <div class="contacts-item-right">
                                <h3>WORKING HOURS</h3>
                                <p class="contact-address">
                                    Sat to Thur: 9am to 8pm
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <footer class="footer">
                <div class="footer-container">
                    <div class="footer-contact-us">
                        <h3>Contact Us</h3>
                        <ul>
                            <li>2946 Angus Road, NY</li>
                            <li>+31 123 456 7890</li>
                            <li>contact@edge.com</li>
                        </ul>
                    </div>
                    <div class="footer-account">
                        <h3>Account</h3>
                        <ul>
                            <li>Sign in</li>
                            <li>Create account</li>
                            <li>IOS App</li>
                            <li>Android App</li>
                        </ul>
                    </div>
                    <div class="footer-company">
                        <h3>Company</h3>
                        <ul>
                            <li>About Us</li>
                            <li>Services</li>
                            <li>Our Team</li>
                            <li>Contacts</li>
                        </ul>
                    </div>
                    <div class="footer-legal">
                        <h3>LEGAL</h3>
                        <ul>
                            <li>Claims</li>
                            <li>Privacy</li>
                            <li>Terms</li>
                            <li>Policies</li>
                        </ul>
                    </div>


                    <div class="footer-subscribe">
                        <h3>SUBSCRIBE TO OUR NEWSLETTER</h3>
                        <p>The latest news, articles, and resources, sent to your inbox weekly.</p>
                        <div class="subscribe-actions">
                            <input type="email" placeholder="Enter your email address">
                            <button class="btn btn-subscribe">
                                Subscribe
                            </button>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">
                    <h3 class="Poiret">edge</h3>
                    <p class="footer__copyright">
                        &copy; Copyright by
                        <a class="footer__link twitter-link" href="https://twitter.com/ibrahim_askar11">Ibrahim Askar
                        </a>All rights reserved
                    </p>
                </div>
                </div>
            </footer>
    </main>
    <script defer>
    const btn = document.querySelector(".navbar-btn");
    btn.onclick = function() {
        if (document.querySelector('.navbar-mobile').style.display !== "none") {
            document.querySelector('.navbar-mobile').style.display = "none";
        } else {
            document.querySelector('.navbar-mobile').style.display = "block";
        }
    };
    </script>
</body>

</html>