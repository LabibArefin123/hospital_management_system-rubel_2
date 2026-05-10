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
                        Welcome {{ $doctor->name }}
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

       {{-- Card Box section --}}
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
@endsection
