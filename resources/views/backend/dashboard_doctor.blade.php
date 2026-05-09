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

        {{-- =======================================================
            APPOINTMENT GRID
        ======================================================== --}}
        <div class="row mt-4">

            @forelse($appointments as $appointment)

                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body d-flex flex-column">

                            {{-- TOP --}}
                            <div class="d-flex justify-content-between align-items-start mb-3">

                                <div>

                                    <h5 class="font-weight-bold mb-1">
                                        {{ $appointment->name }}
                                    </h5>

                                    <small class="text-muted">

                                        {{ $appointment->age }} Years,
                                        {{ ucfirst($appointment->gender) }}

                                    </small>

                                </div>

                                <div>

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

                                </div>

                            </div>

                            {{-- SPECIALITY --}}
                            <div class="mb-2">

                                <strong>Field:</strong><br>

                                <span class="text-muted">

                                    {{ $doctor->speciality ?? 'N/A' }}

                                </span>

                            </div>

                            {{-- DATE --}}
                            <div class="mb-2">

                                <strong>Date:</strong><br>

                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}

                            </div>

                            {{-- TIME --}}
                            <div class="mb-3">

                                <strong>Time:</strong><br>

                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}

                            </div>

                            {{-- AMOUNT --}}
                            <div class="mb-3">

                                <h4 class="text-success font-weight-bold mb-0">

                                    ৳{{ number_format($appointment->amount, 2) }}

                                </h4>

                            </div>

                            {{-- STATUS --}}
                            <div class="mt-auto">

                                <select class="form-control form-control-sm">

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

            @empty

                <div class="col-12">

                    <div class="alert alert-warning shadow-sm">

                        <i class="fas fa-exclamation-circle mr-2"></i>

                        No appointments found.

                    </div>

                </div>

            @endforelse

        </div>

        {{-- =======================================================
            PAGINATION
        ======================================================== --}}
        <div class="mt-4 d-flex justify-content-center">

            {{ $appointments->links() }}

        </div>

    </div>

@endsection