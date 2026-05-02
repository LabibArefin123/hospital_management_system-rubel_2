@extends('adminlte::page')

@section('title', 'Doctor Information')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Doctor Details</h1>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" class="form-control" value="{{ $doctor->name }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="text" class="form-control" value="{{ $doctor->email }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Phone</label>
                        <input type="text" class="form-control" value="{{ $doctor->phone }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Specialization</label>
                        <input type="text" class="form-control" value="{{ $doctor->specialization }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Status</label>
                        <input type="text" class="form-control"
                            value="{{ $doctor->is_available ? 'Available' : 'Unavailable' }}" readonly>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
