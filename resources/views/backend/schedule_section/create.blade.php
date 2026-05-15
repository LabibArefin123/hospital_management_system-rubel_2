@extends('adminlte::page')

@section('title', 'Create Doctor Schedule')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Add New Doctor Schedule</h1>
        <a href="{{ route('doctor-schedules.index') }}"
            class="btn btn-sm btn-warning d-flex align-items-center gap-1 flex-shrink-0 back-btn">
            <i class="fas fa-arrow-left"></i> Go Back
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('doctor-schedules.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Select Doctor</label>
                            <select name="doctor_id" class="form-control @error('doctor_id') is-invalid @enderror">
                                <option value="">
                                    Choose Doctor
                                </option>

                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}"
                                        {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->name }} ({{ $doctor->speciality }})
                                    </option>
                                @endforeach
                            </select>

                            @error('doctor_id')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                                value="{{ old('date') }}">

                            @error('date')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Time</label>
                            <input type="time" name="time" class="form-control @error('time') is-invalid @enderror"
                                value="{{ old('time') }}">

                            @error('time')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="is_booked" class="form-control @error('is_booked') is-invalid @enderror">
                        <option value="0" {{ old('is_booked') == '0' ? 'selected' : '' }}>Available</option>
                        <option value="1" {{ old('is_booked') == '1' ? 'selected' : '' }}>Booked</option>
                    </select>

                    @error('is_booked')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="card-footer bg-white text-right">
                <button type="submit" class="btn btn-primary px-5">
                    <i class="fas fa-save"></i>
                    Save Schedule
                </button>
            </div>
        </form>
    </div>
@stop
