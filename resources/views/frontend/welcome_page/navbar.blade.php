<nav class="navbar navbar-expand-lg premium-navbar">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('uploads/images/logo2.png') }}" class="brand-logo">
            <div class="ms-2">
                <strong class="brand-name">SusthoCare</strong>
                <small class="brand-tag">Digital Healthcare</small>
            </div>
        </a>

        <!-- Toggle -->
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
            ☰
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-center" id="navMenu">
            <ul class="navbar-nav">
                <li><a class="nav-link active" href="#">Home</a></li>
                <li><a class="nav-link" href="#">Doctors</a></li>
                <li><a class="nav-link" href="#">Services</a></li>
                <li><a class="nav-link" href="#">Appointments</a></li>
                <li><a class="nav-link" href="#">Contact</a></li>
            </ul>
        </div>

        <!-- Actions -->
        <div class="nav-actions">
            <a href="#" class="btn btn-light-outline">Login</a>
            <a href="#" class="btn btn-success-solid">Doctor Panel</a>
        </div>

    </div>
</nav>