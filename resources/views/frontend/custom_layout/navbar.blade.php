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
            <ul class="navbar-nav nav-pill">
                <li>
                    <a class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}"
                        href="{{ route('welcome') }}">
                        Home
                    </a>
                </li>

                <li>
                    <a class="nav-link {{ request()->routeIs('doctor') ? 'active' : '' }}" href="{{ route('doctor') }}">
                        Doctors
                    </a>
                </li>

                <li>
                    <a class="nav-link {{ request()->routeIs('service') ? 'active' : '' }}"
                        href="{{ route('service') }}">
                        Services
                    </a>
                </li>

                <li>
                    <a class="nav-link {{ request()->routeIs('appointment') ? 'active' : '' }}"
                        href="{{ route('appointment') }}">
                        Appointments
                    </a>
                </li>

                <li>
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}">
                        Contact
                    </a>
                </li>
            </ul>
        </div>

        <div class="nav-actions d-flex align-items-center gap-2">

            @php
                $user = auth()->user();

                $dashboardRoute = 'dashboard.user';

                if ($user->role === 'admin') {
                    $dashboardRoute = 'dashboard.default';
                } elseif ($user->role === 'doctor') {
                    $dashboardRoute = 'dashboard.doctor';
                }
            @endphp

            @php
                $user = auth()->user();

                // DEFAULT DASHBOARD
                $dashboardRoute = 'dashboard.user';

                if ($user->hasRole('admin')) {
                    $dashboardRoute = 'dashboard.default';
                } elseif ($user->hasRole('doctor')) {
                    $dashboardRoute = 'dashboard.doctor';
                }
            @endphp

            @auth
                <div class="dropdown">

                    <button class="btn btn-light border dropdown-toggle d-flex align-items-center gap-2" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">

                        <span class="fw-bold">
                            {{ $user->name }}
                        </span>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2">

                        {{-- ================= FRONTEND ================= --}}
                        <li class="px-2 py-1 text-muted small">
                            🌐 Public Area
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('frontend.profile') }}">
                                👤 My Profile
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        {{-- ================= DASHBOARD ================= --}}
                        <li class="px-2 py-1 text-muted small">
                            ⚙️ Dashboard Area
                        </li>

                        <li>
                            <a class="dropdown-item d-flex justify-content-between align-items-center"
                                href="{{ route($dashboardRoute) }}">

                                <span>📊 Dashboard</span>

                                @if ($user->hasRole('admin'))
                                    <span class="badge bg-danger">Admin</span>
                                @elseif ($user->hasRole('doctor'))
                                    <span class="badge bg-primary">Doctor</span>
                                @else
                                    <span class="badge bg-success">User</span>
                                @endif

                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        {{-- ================= LOGOUT ================= --}}
                        <li>
                            <form method="POST" action="{{ route('user.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2">
                                    🚪 Logout
                                </button>
                            </form>
                        </li>

                    </ul>

                </div>
            @endauth

            @guest
                <!-- USER LOGIN (GOOGLE) -->
                <button class="btn btn-light-outline" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Login
                </button>

                <!-- DOCTOR PANEL LOGIN -->
                <a href="{{ route('login') }}" class="btn btn-success-solid">
                    Doctor Panel
                </a>
            @endguest

        </div>
    </div>
</nav>
