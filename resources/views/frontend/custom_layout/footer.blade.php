<footer class="premium-footer">
    <div class="container">

        <div class="row gy-5">

            {{-- BRAND INFO --}}
            <div class="col-lg-5 col-md-12">

                <div class="footer-brand">
                    <div class="footer-logo-wrap">

                        <img src="{{ asset('uploads/images/logo2.png') }}" alt="SusthoCare Logo" class="footer-brand-logo">

                        <div class="footer-logo-text">
                            <h4>SusthoCare</h4>
                            <span>Healthcare Solutions</span>
                        </div>

                    </div>
                    
                    <p class="footer-description">
                        Your trusted partner in healthcare innovation.
                        We're committed to providing exceptional medical care
                        with cutting-edge technology and compassionate service.
                    </p>

                    <div class="footer-contact">

                        <div class="contact-item">
                            <i class="fas fa-phone-alt"></i>
                            <span>+880 1234-567890</span>
                        </div>

                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>support@susthocare.com</span>
                        </div>

                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Dhaka, Bangladesh</span>
                        </div>

                    </div>

                </div>

            </div>

            {{-- QUICK LINKS --}}
            <div class="col-lg-2 col-md-6">

                <div class="footer-widget">

                    <h5>Quick Links</h5>

                    <ul>
                        <li><a href="{{ route('welcome') }}">Home</a></li>
                        <li><a href="{{ route('doctor') }}">Doctors</a></li>
                        <li><a href="{{ route('service') }}">Services</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <li><a href="{{ route('appointment') }}">Appointments</a></li>
                    </ul>

                </div>

            </div>

            {{-- SERVICES --}}
            <div class="col-lg-2 col-md-6">

                <div class="footer-widget">

                    <h5>Our Services</h5>

                    <ul>
                        <li>
                            <a href="{{ route('service.show', 3) }}">
                                Blood Pressure Check
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('service.show', 4) }}">
                                Blood Sugar Test
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('service.show', 5) }}">
                                Full Blood Count
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('service.show', 2) }}">
                                X-Ray Scan
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('service.show', 1) }}">
                                Full Body Checkup
                            </a>
                        </li>
                    </ul>

                </div>

            </div>

            {{-- NEWSLETTER --}}
            <div class="col-lg-3 col-md-12">

                <div class="footer-widget newsletter-widget">

                    <h5>Stay Connected</h5>

                    <p>
                        Subscribe for health tips, medical updates,
                        and wellness insights delivered to your inbox.
                    </p>

                    <form class="newsletter-form">

                        <input type="email" placeholder="Enter your email">

                        <button type="submit">
                            Subscribe
                        </button>

                    </form>

                </div>

            </div>

        </div>

        <hr>

        <div class="footer-bottom text-center">
            <p>
                © {{ date('Y') }} SusthoCare.
                All Rights Reserved.
            </p>
        </div>

    </div>
</footer>
