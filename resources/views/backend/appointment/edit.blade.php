@extends('adminlte::page')

@section('title', 'Edit Appointment')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Appointment</h3>
        <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Patient *</label>
                        <select name="patient_id" class="form-control">
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}"
                                    {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Doctor *</label>
                        <select name="doctor_id" class="form-control">
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}"
                                    {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Date *</label>
                        <input type="date" name="appointment_date" class="form-control"
                            value="{{ $appointment->appointment_date }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Time *</label>
                        <input type="time" name="appointment_time" class="form-control"
                            value="{{ $appointment->appointment_time }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Status *</label>
                        <select name="status" class="form-control">
                            @foreach (['Pending', 'Approved', 'Completed'] as $status)
                                <option value="{{ $status }}"
                                    {{ $appointment->status == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <button class="btn btn-success px-4">Update Appointment</button>
            </form>
        </div>
    </div>
@stop
