<link rel="stylesheet" href="{{ asset('css/frontend/custom_navbar.css') }}">

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm py-3">
    <div class="container">

        <!-- Brand Name (Text Only) -->
        <a href="{{ route('welcome') }}" class="navbar-brand fw-bold text-success" style="font-size: 1.4rem;">
            Lifetime City Hospital
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Center Menu -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a href="{{ route('welcome') }}"
                        class="nav-link custom-link {{ request()->routeIs('welcome') ? 'active' : '' }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#about" class="nav-link custom-link">About</a>
                </li>

                <li class="nav-item">
                    <a href="#departments" class="nav-link custom-link">Departments</a>
                </li>

                <li class="nav-item">
                    <a href="#services" class="nav-link custom-link">Services</a>
                </li>

                <li class="nav-item">
                    <a href="#doctors" class="nav-link custom-link">Doctors</a>
                </li>

                <li class="nav-item">
                    <a href="#contact" class="nav-link custom-link">Contact</a>
                </li>

            </ul>
        </div>

        <!-- Right Side Login -->
        <div class="d-flex">
            <a href="{{ route('login') }}" class="btn btn-success px-4">
                Hospital Login
            </a>
        </div>

    </div>
</nav>
