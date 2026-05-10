@extends('frontend.layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/frontend/login_page/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/frontend/login_page/layout.css') }}">
<link rel="stylesheet" href="{{ asset('css/frontend/login_page/glass.css') }}">
<link rel="stylesheet" href="{{ asset('css/frontend/login_page/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/frontend/login_page/animation.css') }}">
<link rel="stylesheet" href="{{ asset('css/frontend/login_page/responsive.css') }}">

<div class="login-page">

    <!-- Overlay -->
    <div class="bg-overlay"></div>

    <div class="login-container">

        <!-- LEFT SIDE -->
        <div class="brand-side">

            <div class="brand-content">

                <!-- Logo -->
                <a class="navbar-brand custom-brand"
                    href="{{ route('welcome') }}">

                    <img src="{{ asset('uploads/images/logo2.png') }}"
                        class="brand-logo"
                        alt="SusthoCare">

                    <div class="brand-text">
                        <h2>SusthoCare</h2>
                        <span>Digital Healthcare Platform</span>
                    </div>

                </a>

                <!-- Main Content -->
                <div class="brand-main">

                    <div class="welcome-badge">
                        Trusted Healthcare Solution
                    </div>

                    <h1 class="brand-title">
                        Your Health, <br>
                        Our First Priority
                    </h1>

                    <p class="brand-subtitle">
                        Consult experienced doctors, book healthcare services,
                        manage appointments and access digital healthcare
                        solutions anytime with SusthoCare.
                    </p>

                </div>

                <!-- Feature Grid -->
                <div class="feature-grid">

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-user-md"></i>
                        </div>

                        <div>
                            <h6>Doctor Consultation</h6>
                            <p>Consult specialist doctors based on schedules.</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>

                        <div>
                            <h6>Easy Appointments</h6>
                            <p>Book appointments online within minutes.</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>

                        <div>
                            <h6>Healthcare Services</h6>
                            <p>Access multiple healthcare services digitally.</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-heart"></i>
                        </div>

                        <div>
                            <h6>Trusted & Secure</h6>
                            <p>Protected patient information and records.</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="login-side">

            <div class="login-card">

                <!-- Top -->
                <div class="login-header">

                    <div class="login-badge">
                        <i class="fas fa-heartbeat"></i>
                        Secure Login
                    </div>

                    <h2>
                        Welcome Back
                    </h2>

                    <p>
                        Login to continue your healthcare journey with SusthoCare.
                    </p>

                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}">

                    @csrf

                    <!-- Username -->
                    <div class="input-group-custom">

                        <label>Email or Username</label>

                        <div class="input-wrapper">

                            <i class="fas fa-user"></i>

                            <input type="text"
                                name="login"
                                placeholder="Enter your email or username"
                                required>

                        </div>

                    </div>

                    <!-- Password -->
                    <div class="input-group-custom">

                        <label>Password</label>

                        <div class="input-wrapper">

                            <i class="fas fa-lock"></i>

                            <input type="password"
                                name="password"
                                placeholder="Enter your password"
                                required>

                        </div>

                        @error('password')
                            <small class="error-text">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <!-- Remember -->
                    <div class="login-options">

                        <div class="remember-box">

                            <input type="checkbox"
                                id="remember"
                                name="remember">

                            <label for="remember">
                                Remember Me
                            </label>

                        </div>

                        <a href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>

                    </div>

                    <!-- Button -->
                    <button type="submit" class="login-btn">

                        <i class="fas fa-sign-in-alt me-2"></i>

                        Login to Account

                    </button>

                </form>

                <!-- Bottom -->
                <div class="login-footer">

                    <div class="footer-divider"></div>

                    <p>
                        © {{ date('Y') }} SusthoCare Healthcare Platform
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection