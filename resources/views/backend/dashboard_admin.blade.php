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

                @if ($doctor->hasRole('admin'))
                    Administrator Dashboard
                @elseif($doctor->hasRole('doctor'))
                    {{ $doctor->speciality ?? 'Doctor Panel' }}
                {{-- @elseif($doctor->hasRole('staff'))
                    Staff Dashboard
                @elseif($doctor->hasRole('patient'))
                    Patient Dashboard --}}
                @else
                    User Dashboard
                @endif

            </p>
        </div>

        {{-- Card Box section --}}
        @include('backend.dashboard.partials.card-box')

        {{-- Latest Appointment section --}}
        @include('backend.dashboard.partials.latest_appointment')
        @include('backend.dashboard.partials.filter_section')
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
            @include('backend.dashboard.partials.doctor_appointments')
            {{-- Service appointment part --}}
            @include('backend.dashboard.partials.service_appointments')

        </div>
        @include('backend.dashboard.partials.status_modal')
        {{-- PAGINATION --}}
        <div class="mt-4 d-flex justify-content-center">

            {{ $appointments->links() }}

        </div>

    </div>
     <script src="{{ asset('js/custom_backend/dashboard_page/admin/appointment_status.js') }}"></script>
     <script src="{{ asset('js/custom_backend/dashboard_page/admin/filter.js') }}"></script>
@endsection
