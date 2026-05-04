<footer class="premium-footer">
    <div class="container">

        <div class="row">

            <div class="col-md-4">
                <h5>SusthoCare</h5>
                <p>Advanced healthcare system built for Bangladesh.</p>
            </div>

            <div class="col-md-2">
                <h6>Links</h6>
                <ul>
                    <li><a href="{{ route('welcome') }}">Home</a></li>
                    <li><a href="{{ route('doctor') }}">Doctors</a></li>
                    <li><a href="{{ route('service') }}">Service</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h6>Services</h6>
                <ul>
                    <li><a href="{{ route('service_1') }}">Full Body Health Checkup</a></li>
                    <li><a href="{{ route('service_2') }}">X-Ray Scan</a></li>
                    <li><a href="{{ route('service_3') }}">Blood Pressure Check</a></li>
                    <li><a href="{{ route('service_4') }}">Blood Sugar Test</a></li>
                    <li><a href="{{ route('service_5') }}">Full Blood Count (CBC)</a></li>
                  
                </ul>
            </div>

            <div class="col-md-3">
                <h6>Newsletter</h6>
                <input type="email" placeholder="Enter email">
                <button>Subscribe</button>
            </div>

        </div>

        <hr>

        <div class="text-center">
            © {{ date('Y') }} SusthoCare
        </div>

    </div>
</footer>
