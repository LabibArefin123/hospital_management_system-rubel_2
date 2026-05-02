@extends('adminlte::page')

@section('title', 'Add Doctor')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add New Doctor</h3>
        <a href="{{ route('doctors.index') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('doctors.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="form-group col-md-6">
                        <label>Doctor Name *</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Specialization *</label>
                        <select name="specialization" class="form-control">
                            <option>Cardiologist</option>
                            <option>Neurologist</option>
                            <option>Orthopedic</option>
                            <option>Pediatrician</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Availability</label>
                        <select name="is_available" class="form-control">
                            <option value="1">Available</option>
                            <option value="0">Unavailable</option>
                        </select>
                    </div>

                </div>
                <button class="btn btn-success px-4">Save Doctor</button>
            </form>
        </div>
    </div>
@stop
