<nav class="navbar navbar-expand-lg premium-navbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
            <img src="{{ asset('uploads/images/logo2.png') }}" class="brand-logo">

            <div class="ms-2 brand-text">
                <h6 class="mb-0">SusthoCare</h6>
                <small>Digital Healthcare</small>
            </div>
        </a>
        <!-- Toggle -->
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
            ☰
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-center" id="navMenu">
            <ul class="navbar-nav">
                <li><a class="nav-link active" href="{{ route('welcome') }}">Home</a></li>
                <li><a class="nav-link" href="{{ route('doctor') }}">Doctors</a></li>
                <li><a class="nav-link" href="#">Services</a></li>
                <li><a class="nav-link" href="#">Appointments</a></li>
                <li><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>

        <!-- Actions -->
        <div class="nav-actions d-flex align-items-center gap-2">
            <a href="#" class="btn btn-light-outline">Login</a>
            <a href="#" class="btn btn-success-solid">Doctor Panel</a>
        </div>

    </div>
</nav>
