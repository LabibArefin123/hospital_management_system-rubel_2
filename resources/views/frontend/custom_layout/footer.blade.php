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
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h6>Services</h6>
                <ul>
                    <li>Blood Pressure Check</li>
                    <li>Blood Sugar Test</li>
                    <li>Full Blood Count</li>
                    <li>X-Ray Scan</li>
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
