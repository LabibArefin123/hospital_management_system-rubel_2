@extends('adminlte::page')

@section('title', 'Edit Schedule')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3>Edit Schedule Doctor</h3>

        <a href="{{ route('doctor-schedules.index') }}" class="back-btn btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
@stop

@section('content')
    <div class="card shadow border-0">
        <form action="{{ route('doctor-schedules.update', $schedule->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Select Doctor</label>
                            <select name="doctor_id" class="form-control">
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}"
                                        {{ $schedule->doctor_id == $doctor->id ? 'selected' : '' }}>
                                        Dr. {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" value="{{ $schedule->date }}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4"
                        <div class="form-group">
                            <label>Time</label>
                            <input type="time" name="time" value="{{ $schedule->time }}" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="is_booked" class="form-control">
                        <option value="0" {{ $schedule->is_booked == 0 ? 'selected' : '' }}>
                            Available
                        </option>
                        <option value="1" {{ $schedule->is_booked == 1 ? 'selected' : '' }}>
                            Booked
                        </option>
                    </select>
                </div>
            </div>

            <div class="card-footer bg-white text-right">
                <button type="submit" class="btn btn-warning px-5">
                    <i class="fas fa-save"></i>
                    Update Schedule
                </button>
            </div>
        </form>
    </div>
@stop
