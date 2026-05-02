<!-- Simple Footer -->
<footer class="bg-dark text-white py-4" id="contact">
    <link rel="stylesheet" href="{{ asset('css/frontend/custom_footer.css') }}">

    <div class="container">
        <div class="row text-center text-md-start align-items-center">

            <!-- Hospital Info -->
            <div class="col-md-4 mb-3 mb-md-0">
                <h5 class="fw-bold text-success">Lifetime City Hospital</h5>
                <p class="small mb-0">
                    Providing trusted and quality healthcare services with compassion and care.
                </p>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4 mb-3 mb-md-0">
                <h6 class="fw-semibold">Contact Us</h6>
                <p class="small mb-1">📍 123 Main Road, City Center</p>
                <p class="small mb-1">📞 +880 1700-000000</p>
                <p class="small mb-0">✉ info@lifetimehospital.com</p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4">
                <h6 class="fw-semibold">Quick Links</h6>
                <p class="small mb-1 text-white"><a href="#about" class="footer-link">About</a></p>
                <p class="small mb-1 text-white"><a href="#departments" class="footer-link">Departments</a></p>
                <p class="small mb-1 text-white"><a href="#services" class="footer-link">Services</a></p>
                <p class="small mb-0 text-white"><a href="{{ route('login') }}" class="footer-link">Hospital Login</a></p>
            </div>

        </div>

        <!-- Bottom -->
        <div class="text-center small mt-4 pt-3 border-top border-secondary">
            &copy; {{ date('Y') }} Lifetime City Hospital. All rights reserved.
        </div>
    </div>
</footer>
