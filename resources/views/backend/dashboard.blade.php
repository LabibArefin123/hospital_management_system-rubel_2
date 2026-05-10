@extends('adminlte::page')

@section('title', 'Doctor Dashboard')

@section('content')

    <div class="container-fluid">

        {{-- =======================================================
        HEADER
    ======================================================== --}}
        <div class="mb-4">

            <h2 class="font-weight-bold">
                Welcome {{ $doctor->name }}
            </h2>

            <p class="text-muted mb-0">

                @if ($doctor->role == 'admin')
                    Administrator Dashboard
                @elseif($doctor->role == 'doctor')
                    {{ $doctor->speciality ?? 'Doctor Panel' }}
                @else
                    User Dashboard
                @endif

            </p>
        </div>

        {{-- =======================================================
        TOP CARDS
    ======================================================== --}}
        <div class="row">

            {{-- TOTAL APPOINTMENTS --}}
            <div class="col-lg-3 col-md-6">

                <div class="small-box bg-info">

                    <div class="inner">
                        <h3>{{ $totalAppointments }}</h3>
                        <p>Total Appointments</p>
                    </div>

                    <div class="icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>

                </div>

            </div>

            {{-- TOTAL EARNINGS --}}
            <div class="col-lg-3 col-md-6">

                <div class="small-box bg-success">

                    <div class="inner">
                        <h3>৳{{ number_format($totalEarnings, 2) }}</h3>
                        <p>Total Earnings</p>
                    </div>

                    <div class="icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>

                </div>

            </div>

            {{-- COMPLETED --}}
            <div class="col-lg-3 col-md-6">

                <div class="small-box bg-primary">

                    <div class="inner">
                        <h3>{{ $completedAppointments }}</h3>
                        <p>Completed</p>
                    </div>

                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>

                </div>

            </div>

            {{-- CANCELLED --}}
            <div class="col-lg-3 col-md-6">

                <div class="small-box bg-danger">

                    <div class="inner">
                        <h3>{{ $cancelledAppointments }}</h3>
                        <p>Cancelled</p>
                    </div>

                    <div class="icon">
                        <i class="fas fa-times-circle"></i>
                    </div>

                </div>

            </div>

        </div>

        <div class="card card-outline card-success">

            <div class="card-header">
                <h3 class="card-title">
                    Latest Appointments
                </h3>
            </div>

            <div class="card-body p-0">

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($latestAppointments as $appointment)
                            <tr>

                                <td>
                                    {{ $appointment->name }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                </td>

                                <td>

                                    @if ($appointment->status == 'confirmed')
                                        <span class="badge badge-success">
                                            Confirmed
                                        </span>
                                    @elseif($appointment->status == 'cancelled')
                                        <span class="badge badge-danger">
                                            Cancelled
                                        </span>
                                    @else
                                        <span class="badge badge-warning">
                                            Pending
                                        </span>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center">
                                    No appointments found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="row">

            @php

                $doctorAppointments = $appointments->filter(function ($appointment) {
                    return $appointment->doctor;
                });

                $serviceAppointments = $appointments->filter(function ($appointment) {
                    return $appointment->service && !$appointment->doctor;
                });

            @endphp

            {{-- Doctor appointment part --}}
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
                    <div class="col-lg-3 col-md-6 mb-4">

                        <div class="card shadow-sm border-0 h-100 rounded-lg">

                            <div class="card-body">

                                {{-- PATIENT --}}
                                <div class="mb-3">
                                    <h5 class="font-weight-bold mb-1">
                                        {{ $appointment->name }}
                                    </h5>

                                    <p class="mb-0 text-muted">
                                        {{ $appointment->age }} Years, {{ ucfirst($appointment->gender) }}
                                    </p>
                                </div>

                                {{-- DOCTOR SECTION (FIXED ALIGNMENT) --}}
                                <div class="d-flex align-items-center mb-3 p-2 rounded" style="background:#f8f9ff;">

                                    {{-- IMAGE --}}
                                    <div class="mr-3">
                                        <img src="{{ asset($appointment->doctor->image ?? 'images/default-doctor.png') }}"
                                            style="
                            width:55px;
                            height:55px;
                            border-radius:50%;
                            object-fit:cover;
                            border:2px solid #0d6efd;
                         ">
                                    </div>

                                    {{-- DOCTOR INFO --}}
                                    <div class="flex-grow-1">
                                        <div class="font-weight-bold">
                                            {{ $appointment->doctor->name }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $appointment->doctor->speciality ?? 'N/A' }}
                                        </small>
                                    </div>

                                </div>

                                {{-- DATE + TIME --}}
                                <div class="d-flex justify-content-between mb-3 text-muted small">
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

                            </div>

                            {{-- STATUS (FIXED VISUAL ONLY, LOGIC UNCHANGED) --}}
                            <div class="card-footer bg-white border-0 pt-2">

                                <div class="d-flex justify-content-between align-items-center">

                                    {{-- BADGE (UNCHANGED LOGIC) --}}
                                    <div>
                                        @if ($appointment->status == 'confirmed')
                                            <span class="badge badge-success px-3 py-2">Confirmed</span>
                                        @elseif($appointment->status == 'cancelled')
                                            <span class="badge badge-danger px-3 py-2">Cancelled</span>
                                        @else
                                            <span class="badge badge-warning px-3 py-2">Pending</span>
                                        @endif
                                    </div>

                                    {{-- SELECT (UNCHANGED LOGIC) --}}
                                    <select class="form-control form-control-sm appointment-status" style="width: 120px;"
                                        data-id="{{ $appointment->id }}" data-current="{{ $appointment->status }}">

                                        <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>
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
                    <div class="col-lg-3 col-md-6 mb-4">

                        <div class="card shadow-sm border-0 h-100 rounded-lg">

                            <div class="card-body">

                                {{-- PATIENT --}}
                                <div class="mb-3">
                                    <h5 class="font-weight-bold mb-1">
                                        {{ $appointment->name }}
                                    </h5>

                                    <p class="mb-0 text-muted">
                                        {{ $appointment->age }} Years, {{ ucfirst($appointment->gender) }}
                                    </p>
                                </div>

                                {{-- SERVICE PROFILE BLOCK (FIXED LIKE DOCTOR STYLE) --}}
                                <div class="d-flex align-items-center mb-3 p-2 rounded" style="background:#f4fff7;">

                                    {{-- IMAGE --}}
                                    <div class="mr-3">
                                        <img src="{{ asset($appointment->service->image ?? 'images/default-service.jpg') }}"
                                            style="
                            width:55px;
                            height:55px;
                            border-radius:12px;
                            object-fit:cover;
                            border:2px solid #28a745;
                         ">
                                    </div>

                                    {{-- SERVICE INFO --}}
                                    <div class="flex-grow-1">
                                        <div class="font-weight-bold">
                                            {{ $appointment->service->title ?? 'N/A' }}
                                        </div>

                                        <small class="text-muted">
                                            Service Booking
                                        </small>
                                    </div>

                                </div>

                                {{-- DATE + TIME --}}
                                <div class="d-flex justify-content-between mb-3 text-muted small">
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

                            </div>

                            {{-- STATUS FOOTER (LOGIC UNCHANGED, ONLY UI FIXED) --}}
                            <div class="card-footer bg-white border-0 pt-2">

                                <div class="d-flex justify-content-between align-items-center">

                                    {{-- BADGE --}}
                                    <div>
                                        @if ($appointment->status == 'confirmed')
                                            <span class="badge badge-success px-3 py-2">Confirmed</span>
                                        @elseif($appointment->status == 'cancelled')
                                            <span class="badge badge-danger px-3 py-2">Cancelled</span>
                                        @else
                                            <span class="badge badge-warning px-3 py-2">Pending</span>
                                        @endif
                                    </div>

                                    {{-- SELECT --}}
                                    <select class="form-control form-control-sm appointment-status" style="width:120px;"
                                        data-id="{{ $appointment->id }}" data-current="{{ $appointment->status }}">

                                        <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>
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
                @endforeach

            @endif
        </div>

        {{-- status change modal --}}
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
        {{-- PAGINATION --}}
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
