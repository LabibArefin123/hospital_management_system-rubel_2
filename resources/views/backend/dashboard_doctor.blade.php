@extends('adminlte::page')

@section('title', 'Doctor Dashboard')

@section('content')

    <div class="container-fluid">

        {{-- =======================================================
            HEADER
        ======================================================== --}}
        <div class="mb-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <!-- LEFT -->
                <div>

                    <h2 class="font-weight-bold mb-1">
                        Welcome {{ $doctor->name }}
                    </h2>

                    <p class="text-muted mb-0">
                        {{ $doctor->speciality ?? 'Doctor Panel' }}
                    </p>

                </div>

                <!-- RIGHT -->
                <div class="mt-2 mt-md-0 d-flex align-items-center gap-2">

                    <!-- FILTER BUTTON -->
                    <button class="btn btn-outline-primary rounded-pill px-4" id="toggleFilterBtn" type="button">

                        <i class="fas fa-filter me-2"></i>

                        Filter

                        <i class="fas fa-chevron-down ms-2" id="filterArrow"></i>

                    </button>

                    <!-- DASHBOARD BADGE -->
                    <span class="badge bg-success px-4 py-2">

                        Doctor Dashboard

                    </span>

                </div>

            </div>

        </div>
        {{-- Card Box section --}}
        @include('backend.dashboard.partials.top_filter')
        @include('backend.dashboard.partials.card-box')

        {{-- Latest Appointment section --}}
        @include('backend.dashboard.partials.latest_appointment')
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
    <script src="{{ asset('js/custom_backend/dashboard_page/doctor/filter.js') }}"></script>
@endsection
