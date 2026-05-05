<nav class="navbar navbar-expand-lg premium-navbar sticky-header">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
            <img src="{{ asset('uploads/images/logo2.png') }}" class="brand-logo">
            <div class="ms-2 brand-text">
                <h6 class="mb-0">SusthoCare</h6>
                <small>Digital Healthcare</small>
            </div>
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
            ☰
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navMenu">
            <ul class="navbar-nav">
                <li><a class="nav-link" href="{{ route('welcome') }}">Home</a></li>
                <li><a class="nav-link" href="{{ route('doctor') }}">Doctors</a></li>
                <li><a class="nav-link" href="{{ route('service') }}">Services</a></li>
                <li><a class="nav-link" href="{{ route('appointment') }}">Appointments</a></li>
                <li><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>

        <div class="nav-actions d-flex align-items-center gap-2">

            @auth
                <div class="dropdown">

                    <button class="btn btn-light-outline dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">

                        {{ auth()->user()->name }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow">

                        <li>
                            <a class="dropdown-item" href="{{ route('frontend.profile') }}">
                                👤 Profile
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('user.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    🚪 Logout
                                </button>
                            </form>
                        </li>

                    </ul>
                </div>
            @endauth

            @guest
                <button class="btn btn-light-outline" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Login
                </button>
            @endguest

            <a href="{{ route('login') }}" class="btn btn-success-solid">
                Doctor Panel
            </a>

        </div>
    </div>
</nav>
