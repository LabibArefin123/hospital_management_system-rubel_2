@extends('adminlte::page')

@section('title', 'Doctor Dashboard')

@section('content')

    <div class="container-fluid">

        {{-- =======================================================
            HEADER
        ======================================================== --}}
        <div class="mb-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h2 class="font-weight-bold mb-1">
                        Welcome Dr. {{ $doctor->name }}
                    </h2>

                    <p class="text-muted mb-0">

                        {{ $doctor->speciality ?? 'Doctor Panel' }}

                    </p>

                </div>

                <div class="mt-2 mt-md-0">

                    <span class="badge badge-success px-4 py-2">
                        Doctor Dashboard
                    </span>

                </div>

            </div>

        </div>

        {{-- =======================================================
            TOP CARDS
        ======================================================== --}}
        <div class="row">

            {{-- TOTAL --}}
            <div class="col-lg-3 col-md-6 col-12">

                <div class="small-box bg-info shadow-sm">

                    <div class="inner">

                        <h3>
                            {{ $totalAppointments }}
                        </h3>

                        <p>
                            Total Appointments
                        </p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>

                </div>

            </div>

            {{-- EARNINGS --}}
            <div class="col-lg-3 col-md-6 col-12">

                <div class="small-box bg-success shadow-sm">

                    <div class="inner">

                        <h3>
                            ৳{{ number_format($totalEarnings, 2) }}
                        </h3>

                        <p>
                            Total Earnings
                        </p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>

                </div>

            </div>

            {{-- CONFIRMED --}}
            <div class="col-lg-3 col-md-6 col-12">

                <div class="small-box bg-primary shadow-sm">

                    <div class="inner">

                        <h3>
                            {{ $completedAppointments }}
                        </h3>

                        <p>
                            Confirmed
                        </p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>

                </div>

            </div>

            {{-- CANCELLED --}}
            <div class="col-lg-3 col-md-6 col-12">

                <div class="small-box bg-danger shadow-sm">

                    <div class="inner">

                        <h3>
                            {{ $cancelledAppointments }}
                        </h3>

                        <p>
                            Cancelled
                        </p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-times-circle"></i>
                    </div>

                </div>

            </div>

        </div>

        {{-- =======================================================
            LATEST APPOINTMENTS
        ======================================================== --}}
        <div class="card card-outline card-success shadow-sm">

            <div class="card-header border-0">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <h3 class="card-title font-weight-bold">
                        Latest Appointments
                    </h3>

                    <span class="badge badge-success px-3 py-2">
                        {{ $latestAppointments->count() }} Latest
                    </span>

                </div>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover mb-0">

                        <thead class="bg-light">

                            <tr>
                                <th>Patient</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Amount</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($latestAppointments as $appointment)
                                <tr>

                                    {{-- PATIENT --}}
                                    <td>

                                        <div class="font-weight-bold">
                                            {{ $appointment->name }}
                                        </div>

                                        <small class="text-muted">

                                            {{ $appointment->age }} Years,
                                            {{ ucfirst($appointment->gender) }}

                                        </small>

                                    </td>

                                    {{-- DATE --}}
                                    <td>

                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}

                                    </td>

                                    {{-- TIME --}}
                                    <td>

                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}

                                    </td>

                                    {{-- STATUS --}}
                                    <td>

                                        @if ($appointment->status == 'confirmed')
                                            <span class="badge badge-success px-3 py-2">
                                                Confirmed
                                            </span>
                                        @elseif($appointment->status == 'cancelled')
                                            <span class="badge badge-danger px-3 py-2">
                                                Cancelled
                                            </span>
                                        @else
                                            <span class="badge badge-warning px-3 py-2">
                                                Pending
                                            </span>
                                        @endif

                                    </td>

                                    {{-- AMOUNT --}}
                                    <td>

                                        <span class="font-weight-bold text-success">
                                            ৳{{ number_format($appointment->amount, 2) }}
                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="text-center py-4">

                                        <div class="text-muted">

                                            No appointments found.

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="row">

            {{-- =======================================================
        APPOINTMENT GROUPING
    ======================================================== --}}
            @php

                $doctorAppointments = $appointments->filter(function ($appointment) {
                    return $appointment->doctor;
                });

                $serviceAppointments = $appointments->filter(function ($appointment) {
                    return $appointment->service && !$appointment->doctor;
                });

            @endphp

            {{-- =======================================================
        DOCTOR CONSULTATIONS
    ======================================================== --}}
            @if ($doctorAppointments->count())

                <div class="col-12 mb-4">

                    <div class="d-flex align-items-center justify-content-between">

                        <h4 class="font-weight-bold text-primary mb-0">
                            Doctor Consultations
                        </h4>

                        <span class="badge badge-primary px-3 py-2">
                            {{ $doctorAppointments->count() }} Appointments
                        </span>

                    </div>

                    <hr>

                </div>

                @foreach ($doctorAppointments as $appointment)
                    <div class="col-lg-3 col-md-6">

                        <div class="card shadow-sm border-0 h-100">

                            <div class="card-body">

                                {{-- TOP INFO --}}
                                <div class="d-flex justify-content-between align-items-start mb-3">

                                    <div>

                                        {{-- PATIENT --}}
                                        <h5 class="font-weight-bold mb-1">
                                            {{ $appointment->name }}
                                        </h5>

                                        {{-- AGE + GENDER --}}
                                        <p class="mb-0 text-muted">
                                            {{ $appointment->age }} Years,
                                            {{ ucfirst($appointment->gender) }}
                                        </p>

                                    </div>

                                    {{-- DOCTOR IMAGE --}}
                                    <div>

                                        @if ($appointment->doctor->image)
                                            <img src="{{ asset($appointment->doctor->image) }}"
                                                alt="{{ $appointment->doctor->name }}" class="shadow-sm"
                                                style="
                                            width: 70px;
                                            height: 70px;
                                            border-radius: 50%;
                                            object-fit: cover;
                                            border: 3px solid #0d6efd;
                                        ">
                                        @else
                                            <img src="{{ asset('images/default-doctor.png') }}" alt="Doctor"
                                                class="shadow-sm"
                                                style="
                                            width: 70px;
                                            height: 70px;
                                            border-radius: 50%;
                                            object-fit: cover;
                                            border: 3px solid #0d6efd;
                                        ">
                                        @endif

                                    </div>

                                </div>

                                {{-- DOCTOR --}}
                                <p class="mb-1">

                                    <strong>
                                        Doctor:
                                    </strong>

                                    {{ $appointment->doctor->name }}

                                </p>

                                {{-- SPECIALITY --}}
                                <p class="mb-2">

                                    <strong>
                                        Speciality:
                                    </strong>

                                    {{ $appointment->doctor->speciality ?? 'N/A' }}

                                </p>

                                {{-- DATE + TIME --}}
                                <div class="d-flex justify-content-between mb-3">

                                    <span>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                                    </span>

                                    <span>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                    </span>

                                </div>

                                {{-- AMOUNT --}}
                                <h5 class="text-success font-weight-bold mb-3">

                                    ৳{{ number_format($appointment->amount, 2) }}

                                </h5>

                                {{-- STATUS --}}
                                <div class="d-flex align-items-center justify-content-between">

                                    {{-- BADGE --}}
                                    <div>

                                        @if ($appointment->status == 'confirmed')
                                            <span class="badge badge-success px-3 py-2">
                                                Confirmed
                                            </span>
                                        @elseif($appointment->status == 'cancelled')
                                            <span class="badge badge-danger px-3 py-2">
                                                Cancelled
                                            </span>
                                        @else
                                            <span class="badge badge-warning px-3 py-2">
                                                Pending
                                            </span>
                                        @endif

                                    </div>

                                    {{-- STATUS SELECT --}}
                                    <div>

                                        <select class="form-control form-control-sm appointment-status"
                                            data-id="{{ $appointment->id }}" data-current="{{ $appointment->status }}">

                                            <option value="pending"
                                                {{ $appointment->status == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option value="confirmed"
                                                {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>
                                                Confirmed
                                            </option>

                                            <option value="cancelled"
                                                {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                @endforeach

            @endif

            {{-- =======================================================
        SERVICE BOOKINGS
    ======================================================== --}}
            @if ($serviceAppointments->count())

                <div class="col-12 mt-5 mb-4">

                    <div class="d-flex align-items-center justify-content-between">

                        <h4 class="font-weight-bold text-success mb-0">
                            Service Bookings
                        </h4>

                        <span class="badge badge-success px-3 py-2">
                            {{ $serviceAppointments->count() }} Bookings
                        </span>

                    </div>

                    <hr>

                </div>

                @foreach ($serviceAppointments as $appointment)
                    <div class="col-lg-3 col-md-6">

                        <div class="card shadow-sm border-0 border-success h-100">

                            <div class="card-body">

                                {{-- TOP INFO --}}
                                <div class="d-flex justify-content-between align-items-start mb-3">

                                    <div>

                                        {{-- PATIENT --}}
                                        <h5 class="font-weight-bold mb-1">
                                            {{ $appointment->name }}
                                        </h5>

                                        {{-- AGE + GENDER --}}
                                        <p class="mb-0 text-muted">
                                            {{ $appointment->age }} Years,
                                            {{ ucfirst($appointment->gender) }}
                                        </p>

                                    </div>

                                    {{-- SERVICE IMAGE --}}
                                    <div>

                                        @if ($appointment->service->image)
                                            <img src="{{ asset($appointment->service->image) }}"
                                                alt="{{ $appointment->service->title }}" class="shadow-sm"
                                                style="
                                            width: 75px;
                                            height: 75px;
                                            object-fit: cover;
                                            border-radius: 12px;
                                            border: 3px solid #28a745;
                                        ">
                                        @else
                                            <img src="{{ asset('images/default-service.jpg') }}" alt="Service"
                                                class="shadow-sm"
                                                style="
                                            width: 75px;
                                            height: 75px;
                                            object-fit: cover;
                                            border-radius: 12px;
                                            border: 3px solid #28a745;
                                        ">
                                        @endif

                                    </div>

                                </div>

                                {{-- SERVICE --}}
                                <p class="mb-2">

                                    <strong>
                                        Service:
                                    </strong>

                                    {{ $appointment->service->title ?? 'N/A' }}

                                </p>

                                {{-- DATE + TIME --}}
                                <div class="d-flex justify-content-between mb-3">

                                    <span>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                                    </span>

                                    <span>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                    </span>

                                </div>

                                {{-- AMOUNT --}}
                                <h5 class="text-success font-weight-bold mb-3">

                                    ৳{{ number_format($appointment->amount, 2) }}

                                </h5>

                                {{-- STATUS --}}
                                <div class="d-flex align-items-center justify-content-between">

                                    {{-- BADGE --}}
                                    <div>

                                        @if ($appointment->status == 'confirmed')
                                            <span class="badge badge-success px-3 py-2">
                                                Confirmed
                                            </span>
                                        @elseif($appointment->status == 'cancelled')
                                            <span class="badge badge-danger px-3 py-2">
                                                Cancelled
                                            </span>
                                        @else
                                            <span class="badge badge-warning px-3 py-2">
                                                Pending
                                            </span>
                                        @endif

                                    </div>

                                    {{-- STATUS SELECT --}}
                                    <div>

                                        <select class="form-control form-control-sm appointment-status"
                                            data-id="{{ $appointment->id }}" data-current="{{ $appointment->status }}">

                                            <option value="pending"
                                                {{ $appointment->status == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option value="confirmed"
                                                {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>
                                                Confirmed
                                            </option>

                                            <option value="cancelled"
                                                {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                @endforeach

            @endif

        </div>

        {{-- =======================================================
    STATUS CHANGE MODAL
======================================================= --}}
        <div class="modal fade" id="statusChangeModal" tabindex="-1" role="dialog">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 shadow">

                    <div class="modal-header bg-primary">

                        <h5 class="modal-title">
                            Confirm Status Change
                        </h5>

                        <button type="button" class="close text-white" data-dismiss="modal">
                            <span>&times;</span>
                        </button>

                    </div>

                    <div class="modal-body text-center">

                        <h5 id="statusChangeText">
                            Do you want to change status?
                        </h5>

                    </div>

                    <div class="modal-footer justify-content-center">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            No
                        </button>

                        <form id="statusChangeForm" method="POST">

                            @csrf

                            <input type="hidden" name="status" id="selectedStatus">

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i>
                                Yes
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        {{-- =======================================================
            PAGINATION
        ======================================================== --}}
        <div class="mt-4 d-flex justify-content-center">

            {{ $appointments->links() }}

        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let selectedAppointmentId = null;

            document.querySelectorAll('.appointment-status')
                .forEach(function(select) {

                    select.addEventListener('change', function() {

                        const appointmentId = this.dataset.id;

                        const selectedStatus = this.value;

                        const currentStatus = this.dataset.current;

                        /*
                        |--------------------------------------------------------------------------
                        | MODAL TEXT
                        |--------------------------------------------------------------------------
                        */

                        document.getElementById('statusChangeText')
                            .innerText =
                            `Do you want to change status to "${selectedStatus}" ?`;

                        /*
                        |--------------------------------------------------------------------------
                        | FORM ACTION
                        |--------------------------------------------------------------------------
                        */

                        document.getElementById('statusChangeForm')
                            .action =
                            `/appointments/change-status/${appointmentId}`;

                        /*
                        |--------------------------------------------------------------------------
                        | STATUS VALUE
                        |--------------------------------------------------------------------------
                        */

                        document.getElementById('selectedStatus')
                            .value = selectedStatus;

                        /*
                        |--------------------------------------------------------------------------
                        | SHOW MODAL
                        |--------------------------------------------------------------------------
                        */

                        $('#statusChangeModal').modal('show');

                        /*
                        |--------------------------------------------------------------------------
                        | RESET ON CANCEL
                        |--------------------------------------------------------------------------
                        */

                        $('#statusChangeModal').on('hidden.bs.modal', function() {

                            select.value = currentStatus;
                        });
                    });
                });

        });
    </script>
@endsection
