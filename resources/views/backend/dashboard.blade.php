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

        {{-- =======================================================
        LATEST + TOTAL
    ======================================================== --}}
        <div class="row">

            {{-- LATEST --}}
            <div class="col-lg-12">

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
                                    <th>Doctor</th>
                                    <th>Date</th>
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
                                            {{ $appointment->doctor->name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
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

            </div>
        </div>

        {{-- =======================================================
        APPOINTMENT GRID
    ======================================================== --}}
        <div class="row">

            @forelse($appointments as $appointment)
                <div class="col-lg-3 col-md-6">

                    <div class="card shadow-sm border-0">

                        <div class="card-body">

                            {{-- PATIENT --}}
                            <h5 class="font-weight-bold mb-2">
                                {{ $appointment->name }}
                            </h5>

                            {{-- AGE + GENDER --}}
                            <p class="mb-1 text-muted">
                                {{ $appointment->age }} Years,
                                {{ ucfirst($appointment->gender) }}
                            </p>

                            {{-- DOCTOR --}}
                            <p class="mb-1">
                                <strong>Doctor:</strong>
                                {{ $appointment->doctor->name ?? 'N/A' }}
                            </p>

                            {{-- SERVICE --}}
                            <p class="mb-2">
                                <strong>Field:</strong>
                                {{ $appointment->doctor->speciality ?? 'N/A' }}
                            </p>

                            {{-- DATE + TIME --}}
                            <div class="d-flex justify-content-between mb-2">

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

                                    <select class="form-control form-control-sm">

                                        <option {{ $appointment->status == 'pending' ? 'selected' : '' }}>
                                            pending
                                        </option>

                                        <option {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>
                                            confirmed
                                        </option>

                                        <option {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>
                                            cancelled
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-warning">
                        No appointments found.
                    </div>

                </div>
            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div class="mt-4 d-flex justify-content-center">

            {{ $appointments->links() }}

        </div>

    </div>

@endsection
