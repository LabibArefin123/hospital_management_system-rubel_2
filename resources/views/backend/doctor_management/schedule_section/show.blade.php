@extends('adminlte::page')

@section('title', 'Schedule Details')

@section('content_header')
    <h1 class="font-weight-bold">
        <i class="fas fa-calendar-day text-info"></i>
        Schedule Details
    </h1>
@stop

@section('content')

    <div class="card shadow border-0">

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="250">Doctor</th>
                    <td>
                        Dr. {{ $schedule->doctor->name ?? 'N/A' }}
                    </td>
                </tr>

                <tr>
                    <th>Date</th>
                    <td>
                        {{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}
                    </td>
                </tr>

                <tr>
                    <th>Time</th>
                    <td>
                        {{ \Carbon\Carbon::parse($schedule->time)->format('h:i A') }}
                    </td>
                </tr>

                <tr>
                    <th>Status</th>

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

                </tr>

            </table>

        </div>

    </div>

@stop
