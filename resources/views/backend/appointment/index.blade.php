@extends('adminlte::page')

@section('title', 'Appointments')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1>Appointment List</h1>
        <a href="{{ route('appointments.create') }}" class="btn btn-success btn-sm">
            + Add Appointment
        </a>
    </div>
@stop

@section('content')
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover text-nowrap" id="dataTables">
                <thead>
                    <tr>
                        <th class="text-center">SL</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $appointment->patient->name }}</td>
                            <td>{{ $appointment->doctor->name }}</td>
                            <td>{{ $appointment->appointment_date }}</td>
                            <td>{{ $appointment->appointment_time }}</td>
                            <td>
                                <span class="badge bg-info">{{ $appointment->status }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('appointments.show', $appointment->id) }}"
                                    class="btn btn-sm btn-warning">Show</a>
                                <a href="{{ route('appointments.edit', $appointment->id) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Delete this appointment?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No appointments found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
