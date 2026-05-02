@extends('adminlte::page')

@section('title', 'Appointment Information')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Appointment Details</h1>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label>Patient</label>
                        <input type="text" class="form-control" value="{{ $appointment->patient->name }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Doctor</label>
                        <input type="text" class="form-control" value="{{ $appointment->doctor->name }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Appointment Date</label>
                        <input type="text" class="form-control" value="{{ $appointment->appointment_date }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Appointment Time</label>
                        <input type="text" class="form-control" value="{{ $appointment->appointment_time }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Status</label>
                        <input type="text" class="form-control" value="{{ $appointment->status }}" readonly>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
