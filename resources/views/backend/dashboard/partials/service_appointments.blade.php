    @php
        $serviceAppointments = $appointments->filter(fn($a) => $a->service && !$a->doctor);
    @endphp

    @if ($serviceAppointments->count())

        <div class="col-12 mt-5 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="font-weight-bold text-success mb-0">Service Bookings</h4>
                <span class="badge badge-success px-3 py-2">
                    {{ $serviceAppointments->count() }} Bookings
                </span>
            </div>
            <hr>
        </div>

        @foreach ($serviceAppointments as $appointment)
            <div class="col-lg-3 col-md-6">
                <div class="card shadow-sm border-success h-100">
                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <h5 class="font-weight-bold mb-1">{{ $appointment->name }}</h5>
                                <p class="mb-0 text-muted">
                                    {{ $appointment->age }} Years, {{ ucfirst($appointment->gender) }}
                                </p>
                            </div>

                            <div>
                                <img src="{{ asset($appointment->service->image ?? 'images/default-service.jpg') }}"
                                    style="width:75px;height:75px;border-radius:12px;object-fit:cover;border:3px solid #28a745;">
                            </div>
                        </div>

                        <p><strong>Service:</strong> {{ $appointment->service->title ?? 'N/A' }}</p>

                        <div class="d-flex justify-content-between mb-3">
                            <span>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</span>
                            <span>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span>
                        </div>

                        <h5 class="text-success font-weight-bold">
                            ৳{{ number_format($appointment->amount, 2) }}
                        </h5>

                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                @if ($appointment->status == 'confirmed')
                                    <span class="badge badge-success">Confirmed</span>
                                @elseif($appointment->status == 'cancelled')
                                    <span class="badge badge-danger">Cancelled</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </div>

                            <select class="form-control form-control-sm appointment-status"
                                data-id="{{ $appointment->id }}" data-current="{{ $appointment->status }}">
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
