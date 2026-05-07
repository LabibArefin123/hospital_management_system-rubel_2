@extends('adminlte::page')

@section('title', 'SusthoCare Hospital Dashboard')

@section('content')

    <div class="container py-4">

        <h3 class="mb-4 fw-bold text-success">
            Welcome to SusthoCare Hospital Dashboard
        </h3>

        <div class="row g-4">
            <!-- Doctors -->
            {{-- <div class="col-md-3 col-6">
                <a href="{{ route('doctors.index') }}" class="text-decoration-none">
                    <div class="card dashboard-card bg-primary text-white text-center shadow-sm h-100">
                        <div class="card-body">
                            <i class="bi bi-person-badge fs-1 mb-2"></i>
                            <h4>{{ $totalDoctors }}</h4>
                            <p class="mb-0">Total Doctors</p>
                        </div>
                    </div>
                </a>
            </div> --}}
    </div>

    <style>
        .dashboard-card {
            border-radius: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            opacity: 0.95;
        }
    </style>

@stop
