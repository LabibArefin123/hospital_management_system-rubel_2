@extends('frontend.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/glass.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/responsive.css') }}">

    <div class="login-page">

        <div class="bg-overlay"></div>

        <div class="login-container">

            <!-- LEFT -->
            <div class="brand-side">

                <div class="brand-content">

                    <a class="navbar-brand custom-brand" href="{{ route('welcome') }}">

                        <img src="{{ asset('uploads/images/logo2.png') }}" class="brand-logo" alt="SusthoCare">

                        <div class="brand-text">
                            <h2>SusthoCare</h2>
                            <span>Digital Healthcare Platform</span>
                        </div>

                    </a>

                    <div class="brand-main">

                        <div class="welcome-badge">
                            Trusted Healthcare Solution
                        </div>

                        <h1 class="brand-title">
                            Smart Digital Healthcare Experience
                        </h1>

                        <p class="brand-subtitle">
                            Book appointments, consult doctors,
                            access healthcare services and manage your
                            healthcare journey digitally with SusthoCare.
                        </p>

                    </div>

                    <div class="feature-grid">

                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-user-md"></i>
                            </div>

                            <div>
                                <h6>Doctor Consultation</h6>
                                <p>Specialist doctor appointments.</p>
                            </div>
                        </div>

                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>

                            <div>
                                <h6>Easy Booking</h6>
                                <p>Quick appointment scheduling.</p>
                            </div>
                        </div>

                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-stethoscope"></i>
                            </div>

                            <div>
                                <h6>Healthcare Services</h6>
                                <p>Digital medical services access.</p>
                            </div>
                        </div>

                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-shield-heart"></i>
                            </div>

                            <div>
                                <h6>Secure Platform</h6>
                                <p>Protected patient information.</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="login-side">

                <div class="login-card">

                    @yield('auth_content')

                </div>

            </div>

        </div>

    </div>
@endsection
