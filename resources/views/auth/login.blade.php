@extends('frontend.layouts.app')

@section('content')
    <div class="login-wrapper d-flex justify-content-center align-items-center vh-100">
        <div class="login-glass p-4 shadow-sm rounded-4" style="max-width: 400px; width: 100%; text-align:center;">
            <!-- LOGIN PANEL -->
            <div class="login-panel">
                <h4 class="fw-bold mb-2">Welcome Back!</h4>
                <p class="text-muted small mb-4">Please login to continue</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3 text-start">
                        <label class="form-label fw-semibold">Email or Username</label>
                        <input type="text" name="login" class="form-control form-control-lg rounded-pill"
                            placeholder="Enter email or username" required>
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg rounded-pill"
                            placeholder="Enter password" required>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-success w-100 rounded-pill py-2 mb-3">Login</button>

                    <div class="text-center">
                        <a href="{{ route('password.request') }}" class="text-decoration-none small">Forgot Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- STYLES -->
    <style>
        body {
            background: url('{{ asset('uploads/images/login_page/wallpaper.jpg') }}') center/cover no-repeat;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-wrapper {
            flex-wrap: wrap;
        }

        .login-glass {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .login-panel h4 {
            color: #2b2b2b;
        }

        .login-panel p {
            color: #555;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
            border-color: #28a745;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
        }
    </style>
@endsection
