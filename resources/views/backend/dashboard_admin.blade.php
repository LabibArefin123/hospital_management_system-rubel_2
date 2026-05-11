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
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /*
            |--------------------------------------------------------------------------
            | STATUS CHANGE MODAL
            |--------------------------------------------------------------------------
            */

            document.querySelectorAll('.appointment-status')
                .forEach(function(select) {

                    select.addEventListener('change', function() {

                        const appointmentId = this.dataset.id;

                        const selectedStatus = this.value;

                        const currentStatus = this.dataset.current;

                        document.getElementById('statusChangeText')
                            .innerText =
                            `Do you want to change status to "${selectedStatus}" ?`;

                        document.getElementById('statusChangeForm')
                            .action =
                            `/appointments/change-status/${appointmentId}`;

                        document.getElementById('selectedStatus')
                            .value = selectedStatus;

                        $('#statusChangeModal').modal('show');

                        $('#statusChangeModal').on('hidden.bs.modal', function() {

                            select.value = currentStatus;
                        });
                    });
                });

            /*
            |--------------------------------------------------------------------------
            | LIVE FILTER
            |--------------------------------------------------------------------------
            */

            const searchInput = document.getElementById('dashboardSearch');

            const typeFilter = document.getElementById('appointmentTypeFilter');

            const statusFilter = document.getElementById('appointmentStatusFilter');

            const cards = document.querySelectorAll('.appointment-card');

            const doctorCountElement = document.getElementById(
                'doctorAppointmentCount');

            const serviceCountElement = document.getElementById(
                'serviceAppointmentCount');

            function filterAppointments() {

                const search = searchInput.value.toLowerCase();

                const type = typeFilter.value.toLowerCase();

                const status = statusFilter.value.toLowerCase();

                let visibleDoctorCount = 0;

                let visibleServiceCount = 0;

                cards.forEach(function(card) {

                    const cardSearch = card.dataset.search;

                    const cardType = card.dataset.type;

                    const cardStatus = card.dataset.status;

                    let matchSearch = cardSearch.includes(search);

                    let matchType = type === '' || cardType === type;

                    let matchStatus = status === '' || cardStatus === status;

                    if (matchSearch && matchType && matchStatus) {

                        card.style.display = 'block';

                        /*
                        |--------------------------------------------------------------------------
                        | COUNT UPDATE
                        |--------------------------------------------------------------------------
                        */

                        if (cardType === 'doctor') {

                            visibleDoctorCount++;
                        }

                        if (cardType === 'service') {

                            visibleServiceCount++;
                        }

                    } else {

                        card.style.display = 'none';
                    }
                });

                /*
                |--------------------------------------------------------------------------
                | UPDATE BADGES
                |--------------------------------------------------------------------------
                */

                doctorCountElement.innerText =
                    `${visibleDoctorCount} Appointments`;

                serviceCountElement.innerText =
                    `${visibleServiceCount} Bookings`;
            }

            searchInput.addEventListener('keyup', filterAppointments);

            typeFilter.addEventListener('change', filterAppointments);

            statusFilter.addEventListener('change', filterAppointments);

            /*
            |--------------------------------------------------------------------------
            | RESET FILTER
            |--------------------------------------------------------------------------
            */

            document.getElementById('resetDashboardFilter')
                .addEventListener('click', function() {

                    searchInput.value = '';

                    typeFilter.value = '';

                    statusFilter.value = '';

                    filterAppointments();
                });

        });
    </script>
@endsection
