@extends('adminlte::page')

@section('title', 'Doctor Schedules')

@section('content_header')

    <div class="d-flex justify-content-between">

        <h1 class="font-weight-bold">
            <i class="fas fa-calendar-check text-primary"></i>
            Doctor Schedules
        </h1>

        <a href="{{ route('doctor-schedules.create') }}" class="btn btn-primary">

            <i class="fas fa-plus-circle"></i>
            Add Schedule
        </a>
    </div>

@stop

@section('content')
    <div class="card shadow border-0">
        <div class="card-body table-responsive">
            <table class="table table-hover text-nowrap" id='dataTables'>
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>
                <tbody
                    @forelse($schedules as $schedule)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <strong>
                        {{ $schedule->doctor->name ?? 'N/A' }}
                        </strong>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($schedule->time)->format('h:i A') }}
                    </td>
                    <td>
                        @if ($schedule->is_booked)
                            <span class="badge badge-danger px-3 py-2">
                                Booked
                            </span>
                        @else
                            <span class="badge badge-success px-3 py-2">
                                Available
                            </span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('doctor-schedules.show', $schedule->id) }}"
                           class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('doctor-schedules.edit', $schedule->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('doctor-schedules.destroy', $schedule->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete schedule?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">
                        No Schedule Found
                    </td>
                </tr>

                @endforelse
                    </tbody>

            </table>

        </div>

    </div>

@stop
