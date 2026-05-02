@extends('adminlte::page')

@section('title', 'Patient Information')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Patient Details</h1>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label>Patient Code</label>
                        <input type="text" class="form-control" value="{{ $patient->patient_code }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" class="form-control" value="{{ $patient->name }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label>Age</label>
                        <input type="text" class="form-control" value="{{ $patient->age }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label>Gender</label>
                        <input type="text" class="form-control" value="{{ $patient->gender }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label>Blood Group</label>
                        <input type="text" class="form-control" value="{{ $patient->blood_group }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Phone</label>
                        <input type="text" class="form-control" value="{{ $patient->phone }}" readonly>
                    </div>

                    <div class="col-md-12">
                        <label>Address</label>
                        <textarea class="form-control" readonly>{{ $patient->address }}</textarea>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
