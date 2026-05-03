<nav class="navbar navbar-expand-md navbar-light custom-navbar shadow-sm py-3">
    <div class="container">
        <!-- Brand Section -->
        <a href="#" class="navbar-brand d-flex align-items-center brand-text">

            <!-- Logo Image -->
            <div class="logo-box">

                <img src="{{ asset('uploads/images/logo2.png') }}" alt="SusthoCare Logo" class="brand-logo">
            </div>

            <!-- Text -->
            <div class="ms-2">
                <h5 class="logo-company mb-0">SusthoCare</h5>
                <small class="logo-desc">Healthcare Solutions</small>
            </div>

        </a>
        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Center Menu -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a href="#" class="nav-link custom-link active">Home</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link custom-link">Doctors</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link custom-link">Services</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link custom-link">Appointments</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link custom-link">Contact</a>
                </li>

            </ul>
        </div>

        <!-- Right Side Buttons -->
        <div class="d-flex align-items-center gap-2">

            <a href="#" class="btn btn-outline-success px-3 custom-btn-outline">
                User Login
            </a>

            <a href="#" class="btn btn-success px-3 custom-btn">
                Doctor Admin
            </a>

        </div>

    </div>
</nav>
