@extends('adminlte::page')

@section('title', 'Doctor Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3>Doctor Profile</h3>
        <div>
            <a href="{{ route('doctors.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
@stop

@section('content')

<div class="row">

    <div class="col-md-4">
        <div class="card card-primary card-outline shadow">
            <div class="card-body box-profile text-center">
                @if($doctor->image)
                    <img class="profile-user-img img-fluid img-circle elevation-3"
                         src="{{ asset($doctor->image) }}"
                         style="width: 160px; height: 160px; object-fit: cover;">

                @else
                    <img class="profile-user-img img-fluid img-circle elevation-3"
                         src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}"
                         style="width: 160px; height: 160px;">
                @endif
                <h3 class="profile-username mt-3">
                    Dr. {{ $doctor->name }}
                </h3>
                <p class="text-muted">
                    {{ $doctor->speciality }}
                </p>
                <span class="badge badge-success px-4 py-2">
                    {{ $doctor->availability }}
                </span>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-white">
                <h3 class="card-title font-weight-bold">
                    Professional Information
                </h3>
            </div>

            <div class="card-body">
                <strong>
                    <i class="fas fa-graduation-cap mr-1 text-primary"></i>
                    Qualification
                </strong>
                <p class="text-muted">
                    {{ $doctor->qualification }}
                </p>
                <hr>
                <strong>
                    <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                    Location
                </strong>
                <p class="text-muted">
                    {{ $doctor->location }}
                </p>
                <hr>
                <strong>
                    <i class="fas fa-money-bill-wave mr-1 text-success"></i>
                    Consultation Fee
                </strong>

                <p class="text-muted">
                    ৳ {{ number_format($doctor->consultation_fee, 2) }}
                </p>

            </div>

        </div>

    </div>

    <div class="col-md-8">
        <div class="row">
            <div class="col-md-4">
                <div class="small-box bg-info shadow">
                    <div class="inner">
                        <h3>{{ $doctor->experience_years }}</h3>
                        <p>Years Experience</p>
                    </div>

                    <div class="icon">
                        <i class="fas fa-briefcase-medical"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="small-box bg-success shadow">
                    <div class="inner">
                        <h3>{{ $doctor->success_rate }}%</h3>
                        <p>Success Rate</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="small-box bg-primary shadow">
                    <div class="inner">
                        <h3>{{ $doctor->total_patients }}+</h3>
                        <p>Total Patients</p>
                    </div>

                    <div class="icon">
                        <i class="fas fa-procedures"></i>
                    </div>
                </div>

            </div>

        </div>

        <div class="card shadow">

            <div class="card-header bg-white">

                <h3 class="card-title font-weight-bold">
                    About Doctor
                </h3>

            </div>

            <div class="card-body">

                <p class="text-muted" style="line-height: 2;">
                    {{ $doctor->about }}
                </p>

            </div>
        </div>
    </div>

</div>

@stop