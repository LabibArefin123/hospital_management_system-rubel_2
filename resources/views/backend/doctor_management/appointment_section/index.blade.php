@extends('adminlte::page')

@section('title', 'Appointments')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1 class="font-weight-bold">
        <i class="fas fa-calendar-check text-primary"></i>
        Appointment Management
    </h1>
</div>

@stop

@section('content')

<div class="card shadow border-0">

    <div class="card-body table-responsive">

        <table class="table table-hover text-nowrap">

            <thead class="bg-light">

                <tr>
                    <th>#</th>
                    <th>Patient</th>
                    <th>Type</th>
                    <th>Doctor/Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th width="230">Action</th>
                </tr>

            </thead>

            <tbody>
                @forelse($appointments as $appointment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <strong>
                            {{ $appointment->name }}
                        </strong>

                        <br>
                        <small class="text-muted">
                            {{ $appointment->phone }}
                        </small>

                    </td>
                    <td>

                        <span class="badge badge-info px-3 py-2">
                            {{ ucfirst($appointment->type) }}
                        </span>
                    </td>
                    <td>
                        @if($appointment->doctor)

                            <strong>
                                    {{ $appointment->doctor->name }}
                            </strong>
                        @endif

                        @if($appointment->service)
                            <div>
                                {{ $appointment->service->title }}
                            </div>
                        @endif
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                    </td>
                    <td>
                        ৳ {{ number_format($appointment->amount, 2) }}
                    </td>
                    <td>
                        @if($appointment->status == 'pending')

                            <span class="badge badge-warning px-3 py-2">
                                Pending
                            </span>

                        @elseif($appointment->status == 'confirmed')

                            <span class="badge badge-success px-3 py-2">
                                Confirmed
                            </span>

                        @elseif($appointment->status == 'cancelled')

                            <span class="badge badge-danger px-3 py-2">
                                Cancelled
                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('appointments.show', $appointment->id) }}"
                           class="btn btn-info btn-sm">

                            <i class="fas fa-eye"></i>

                        </a>

                        <a href="{{ route('appointments.cancel', $appointment->id) }}"
                           class="btn btn-secondary btn-sm">

                            <i class="fas fa-ban"></i>

                        </a>

                        <form action="{{ route('appointments.destroy', $appointment->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete appointment?')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="9" class="text-center py-5">

                        <h5 class="text-muted">
                            No Appointment Found
                        </h5>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop