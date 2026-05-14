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

    <div class="container-fluid">

        <div class="row">

            {{-- LEFT SIDE --}}
            <div class="col-lg-4">

                {{-- PROFILE CARD --}}
                <div class="card card-primary card-outline shadow-lg border-0">

                    <div class="card-body text-center">

                        <div class="position-relative d-inline-block mb-3">

                            {{-- DOCTOR IMAGE --}}
                            <img class="profile-user-img img-fluid img-circle elevation-4 border border-primary"
                                src="{{ $doctor->image ? asset($doctor->image) : asset('uploads/images/default.jpg') }}"
                                id="doctorPreviewImage" style="width: 180px; height: 180px; object-fit: cover;">

                            {{-- IMAGE INFO BUTTON --}}
                            @if ($doctor->image)
                                <button type="button" class="btn btn-info btn-sm rounded-circle elevation-2"
                                    data-toggle="modal" data-target="#doctorImageInfoModal"
                                    style="
                    position: absolute;
                    top: 5px;
                    left: 5px;
                    width: 35px;
                    height: 35px;
                    padding: 0;
                ">

                                    <i class="fas fa-info"></i>

                                </button>
                            @endif

                            {{-- STATUS --}}
                            <span class="badge badge-success position-absolute"
                                style="
                                    bottom: 10px;
                                    right: 10px;
                                    font-size: 12px;
                            ">

                                Active

                            </span>

                        </div>

                        <h3 class="profile-username font-weight-bold">

                            Dr. {{ $doctor->name }}

                        </h3>

                        <p class="text-muted mb-3">

                            {{ $doctor->speciality }}

                        </p>

                        <span class="badge badge-primary px-4 py-2">

                            {{ $doctor->availability }}

                        </span>

                    </div>

                </div>

                {{-- PROFESSIONAL INFO --}}
                <div class="card shadow border-0">

                    <div class="card-header bg-white">

                        <h3 class="card-title font-weight-bold">

                            <i class="fas fa-stethoscope text-primary mr-1"></i>
                            Professional Information

                        </h3>

                    </div>

                    <div class="card-body">

                        <div class="mb-4">

                            <strong>
                                <i class="fas fa-graduation-cap text-primary mr-1"></i>
                                Qualification
                            </strong>

                            <p class="text-muted mt-2">
                                {{ $doctor->qualification }}
                            </p>

                        </div>

                        <hr>

                        <div class="mb-4">

                            <strong>
                                <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                Location
                            </strong>

                            <p class="text-muted mt-2">
                                {{ $doctor->location }}
                            </p>

                        </div>

                        <hr>

                        <div>

                            <strong>
                                <i class="fas fa-money-bill-wave text-success mr-1"></i>
                                Consultation Fee
                            </strong>

                            <p class="text-muted mt-2">

                                ৳ {{ number_format($doctor->consultation_fee, 2) }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="col-lg-8">

                {{-- STATISTICS --}}
                <div class="row">

                    <div class="col-md-4">

                        <div class="small-box bg-info shadow-lg">

                            <div class="inner">

                                <h3>
                                    {{ $doctor->experience_years }}
                                </h3>

                                <p>
                                    Years Experience
                                </p>

                            </div>

                            <div class="icon">

                                <i class="fas fa-briefcase-medical"></i>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="small-box bg-success shadow-lg">

                            <div class="inner">

                                <h3>
                                    {{ $doctor->success_rate }}%
                                </h3>

                                <p>
                                    Success Rate
                                </p>

                            </div>

                            <div class="icon">

                                <i class="fas fa-chart-line"></i>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="small-box bg-primary shadow-lg">

                            <div class="inner">

                                <h3>
                                    {{ $doctor->total_patients }}+
                                </h3>

                                <p>
                                    Total Patients
                                </p>

                            </div>

                            <div class="icon">

                                <i class="fas fa-procedures"></i>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- ABOUT --}}
                <div class="card shadow-lg border-0">

                    <div class="card-header bg-white">

                        <h3 class="card-title font-weight-bold">

                            <i class="fas fa-user text-secondary mr-1"></i>
                            About Doctor

                        </h3>

                    </div>

                    <div class="card-body">

                        <p class="text-muted" style="line-height: 2; font-size: 15px;">

                            {{ $doctor->about }}

                        </p>

                    </div>

                </div>

            </div>

        </div>

        @if ($doctor->image)
            <div class="modal fade" id="doctorImageInfoModal" tabindex="-1" role="dialog" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered" role="document">

                    <div class="modal-content border-0 shadow-lg">

                        <div class="modal-header bg-info">

                            <h5 class="modal-title text-white">

                                <i class="fas fa-image mr-2"></i>
                                Doctor Image Information

                            </h5>

                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">

                                <span aria-hidden="true">
                                    &times;
                                </span>

                            </button>

                        </div>

                        <div class="modal-body text-center">

                            {{-- LARGE IMAGE --}}
                            <img src="{{ asset($doctor->image) }}" class="img-fluid rounded shadow mb-4"
                                style="
                            max-height: 300px;
                            object-fit: cover;
                         ">

                            {{-- IMAGE INFO --}}
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover">

                                    <tbody>

                                        <tr>

                                            <th width="40%">
                                                File Name
                                            </th>

                                            <td id="imageFileName">
                                                Loading...
                                            </td>

                                        </tr>

                                        <tr>

                                            <th>
                                                Dimensions
                                            </th>

                                            <td id="imageDimensions">
                                                Loading...
                                            </td>

                                        </tr>

                                        <tr>

                                            <th>
                                                Format
                                            </th>

                                            <td id="imageFormat">
                                                Loading...
                                            </td>

                                        </tr>

                                        <tr>

                                            <th>
                                                Shape
                                            </th>

                                            <td id="imageShape">
                                                Loading...
                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">

                                Close

                            </button>

                        </div>

                    </div>

                </div>

            </div>
        @endif
    </div>
@stop
