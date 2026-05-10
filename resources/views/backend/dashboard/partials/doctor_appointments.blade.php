@php
    $doctorAppointments = $appointments->filter(fn($a) => $a->doctor);
@endphp

@if ($doctorAppointments->count())

<div class="col-12 mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="font-weight-bold text-primary mb-0">Doctor Consultations</h4>
        <span class="badge badge-primary px-3 py-2">
            {{ $doctorAppointments->count() }} Appointments
        </span>
    </div>
    <hr>
</div>

@foreach ($doctorAppointments as $appointment)
<div class="col-lg-3 col-md-6 mb-3">

    <div class="card border-0 shadow-sm h-100 rounded-lg">

        <div class="card-body">

            {{-- TOP SECTION --}}
            <div class="d-flex align-items-center justify-content-between mb-3">

                {{-- PATIENT INFO --}}
                <div style="flex:1">
                    <h5 class="mb-1 font-weight-bold text-dark">
                        {{ $appointment->name }}
                    </h5>

                    <small class="text-muted">
                        {{ $appointment->age }} yrs • {{ ucfirst($appointment->gender) }}
                    </small>
                </div>

                {{-- DOCTOR IMAGE (SOFT AVATAR LOOK) --}}
                <div class="ml-2">
                    <img src="{{ asset($appointment->doctor->image ?? 'images/default-doctor.png') }}"
                         style="
                            width:60px;
                            height:60px;
                            border-radius:50%;
                            object-fit:cover;
                            border:2px solid #0d6efd;
                            box-shadow:0 2px 8px rgba(0,0,0,0.08);
                         ">
                </div>

            </div>

            {{-- INFO --}}
            <div class="mb-2">
                <div><strong>Doctor:</strong> {{ $appointment->doctor->name }}</div>
                <div><strong>Speciality:</strong> {{ $appointment->doctor->speciality ?? 'N/A' }}</div>
            </div>

            <div class="d-flex justify-content-between text-muted small mb-3">
                <span>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</span>
                <span>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span>
            </div>

            <div class="font-weight-bold text-success mb-3">
                ৳{{ number_format($appointment->amount, 2) }}
            </div>

        </div>

        {{-- STATUS FOOTER (FIXED UI) --}}
        <div class="card-footer bg-white border-0 pt-0">

            <div class="d-flex flex-column gap-2">

                {{-- STATUS BADGE --}}
                <div>
                    @if ($appointment->status == 'confirmed')
                        <span class="badge badge-success px-3 py-2 w-100">Confirmed</span>
                    @elseif($appointment->status == 'cancelled')
                        <span class="badge badge-danger px-3 py-2 w-100">Cancelled</span>
                    @else
                        <span class="badge badge-warning px-3 py-2 w-100">Pending</span>
                    @endif
                </div>

                {{-- SELECT --}}
                <select class="form-control appointment-status rounded-pill"
                        data-id="{{ $appointment->id }}"
                        data-current="{{ $appointment->status }}">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>

            </div>

        </div>

    </div>

</div>
@endforeach

@endif