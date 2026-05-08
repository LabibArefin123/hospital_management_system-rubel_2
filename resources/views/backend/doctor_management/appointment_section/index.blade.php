@extends('adminlte::page')

@section('title', 'Appointments')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h1 class="font-weight-bold mb-1">
                <i class="fas fa-calendar-check text-primary"></i>
                Appointment Management
            </h1>

            <p class="text-muted mb-0">
                Manage doctor consultations and service appointments
            </p>

        </div>

    </div>

@stop

@section('content')

    <!-- FILTER + SEARCH -->

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-2">

                    <input type="text" id="searchInput" class="form-control"
                        placeholder="Search patient, doctor or service...">

                </div>

                <div class="col-md-3 mb-2">

                    <select id="statusFilter" class="form-control">

                        <option value="">
                            All Status
                        </option>

                        <option value="pending">
                            Pending
                        </option>

                        <option value="confirmed">
                            Confirmed
                        </option>

                        <option value="cancelled">
                            Cancelled
                        </option>

                    </select>

                </div>

                <div class="col-md-3 mb-2">

                    <select id="typeFilter" class="form-control">

                        <option value="">
                            All Types
                        </option>

                        <option value="doctor">
                            Doctor Consultation
                        </option>

                        <option value="service">
                            Service Appointment
                        </option>

                    </select>

                </div>

            </div>

        </div>

    </div>

    <!-- DOCTOR CONSULTATION SECTION -->

    <div class="d-flex align-items-center justify-content-between mt-4 mb-3">

        <h3 class="font-weight-bold">

            <i class="fas fa-user-md text-primary"></i>
            Doctor Consultations

        </h3>

        <span class="badge badge-primary px-3 py-2">

            {{ $doctorAppointments->count() }} Appointments

        </span>

    </div>

    <div class="row appointment-wrapper">

        @forelse($doctorAppointments as $appointment)
            <div class="col-md-3 mb-4 appointment-card" data-type="{{ strtolower($appointment->type) }}"
                data-status="{{ strtolower($appointment->status) }}"
                data-search="
            {{ strtolower($appointment->name) }}
            {{ strtolower($appointment->doctor->name ?? '') }}
         ">

                <div class="card shadow border-0 h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <h5 class="font-weight-bold mb-1">

                                    {{ $appointment->name }}

                                </h5>

                                <small class="text-muted">

                                    {{ $appointment->phone }}

                                </small>

                            </div>

                            <div>

                                @if ($appointment->status == 'pending')
                                    <span class="badge badge-warning">

                                        Pending

                                    </span>
                                @elseif($appointment->status == 'confirmed')
                                    <span class="badge badge-success">

                                        Confirmed

                                    </span>
                                @elseif($appointment->status == 'cancelled')
                                    <span class="badge badge-danger">

                                        Cancelled

                                    </span>
                                @endif

                            </div>

                        </div>

                        <hr>

                        <p class="mb-2">

                            <i class="fas fa-user-md text-primary"></i>

                            <strong>
                                {{ $appointment->doctor->name ?? 'N/A' }}
                            </strong>

                        </p>

                        <p class="mb-2">

                            <i class="fas fa-calendar text-info"></i>

                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}

                        </p>

                        <p class="mb-2">

                            <i class="fas fa-clock text-success"></i>

                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}

                        </p>

                        <p class="mb-0">

                            <i class="fas fa-money-bill-wave text-warning"></i>

                            ৳ {{ number_format($appointment->amount, 2) }}

                        </p>

                    </div>

                    <div class="card-footer bg-white border-0">

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-info btn-sm">

                                <i class="fas fa-eye"></i>

                            </a>

                            <a href="{{ route('appointments.cancel', $appointment->id) }}"
                                class="btn btn-secondary btn-sm">

                                <i class="fas fa-ban"></i>

                            </a>

                            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete appointment?')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-light text-center shadow-sm">

                    No Doctor Consultation Found

                </div>

            </div>
        @endforelse

    </div>

    <!-- SERVICE SECTION -->

    <div class="d-flex align-items-center justify-content-between mt-4 mb-3">

        <h3 class="font-weight-bold">

            <i class="fas fa-concierge-bell text-success"></i>
            Service Appointments

        </h3>

        <span class="badge badge-success px-3 py-2">

            {{ $serviceAppointments->count() }} Appointments

        </span>

    </div>

    <div class="row appointment-wrapper">

        @forelse($serviceAppointments as $appointment)
            <div class="col-md-3 mb-4 appointment-card" data-type="{{ strtolower($appointment->type) }}"
                data-status="{{ strtolower($appointment->status) }}"
                data-search="
            {{ strtolower($appointment->name) }}
            {{ strtolower($appointment->service->title ?? '') }}
         ">

                <div class="card shadow border-0 h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <h5 class="font-weight-bold mb-1">

                                    {{ $appointment->name }}

                                </h5>

                                <small class="text-muted">

                                    {{ $appointment->phone }}

                                </small>

                            </div>

                            <div>

                                @if ($appointment->status == 'pending')
                                    <span class="badge badge-warning">

                                        Pending

                                    </span>
                                @elseif($appointment->status == 'confirmed')
                                    <span class="badge badge-success">

                                        Confirmed

                                    </span>
                                @elseif($appointment->status == 'cancelled')
                                    <span class="badge badge-danger">

                                        Cancelled

                                    </span>
                                @endif

                            </div>

                        </div>

                        <hr>

                        <p class="mb-2">

                            <i class="fas fa-concierge-bell text-success"></i>

                            <strong>

                                {{ $appointment->service->title ?? 'N/A' }}

                            </strong>

                        </p>

                        <p class="mb-2">

                            <i class="fas fa-calendar text-info"></i>

                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}

                        </p>

                        <p class="mb-2">

                            <i class="fas fa-clock text-success"></i>

                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}

                        </p>

                        <p class="mb-0">

                            <i class="fas fa-money-bill-wave text-warning"></i>

                            ৳ {{ number_format($appointment->amount, 2) }}

                        </p>

                    </div>

                    <div class="card-footer bg-white border-0">

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-info btn-sm">

                                <i class="fas fa-eye"></i>

                            </a>

                            <a href="{{ route('appointments.cancel', $appointment->id) }}"
                                class="btn btn-secondary btn-sm">

                                <i class="fas fa-ban"></i>

                            </a>

                            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete appointment?')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-light text-center shadow-sm">

                    No Service Appointment Found

                </div>

            </div>
        @endforelse

    </div>

@stop

@section('js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const searchInput = document.getElementById('searchInput');

            const statusFilter = document.getElementById('statusFilter');

            const typeFilter = document.getElementById('typeFilter');

            const cards = document.querySelectorAll('.appointment-card');

            function filterAppointments() {

                const search = searchInput.value.toLowerCase();

                const status = statusFilter.value.toLowerCase();

                const type = typeFilter.value.toLowerCase();

                cards.forEach(card => {

                    const cardSearch = card.dataset.search;

                    const cardStatus = card.dataset.status;

                    const cardType = card.dataset.type;

                    const matchSearch =
                        cardSearch.includes(search);

                    const matchStatus = !status || cardStatus === status;

                    const matchType = !type || cardType === type;

                    if (matchSearch && matchStatus && matchType) {

                        card.style.display = 'block';

                    } else {

                        card.style.display = 'none';

                    }

                });

            }

            searchInput.addEventListener('keyup', filterAppointments);

            statusFilter.addEventListener('change', filterAppointments);

            typeFilter.addEventListener('change', filterAppointments);

        });
    </script>

@stop
