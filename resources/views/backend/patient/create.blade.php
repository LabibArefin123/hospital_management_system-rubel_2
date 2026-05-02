@extends('adminlte::page')

@section('title', 'Add Patient')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Add New Patient</h3>
        <a href="{{ route('patients.index') }}" class="btn btn-sm btn-secondary back-btn">Back</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="form-group col-md-6">
                        <label>Patient Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Age *</label>
                        <input type="number" name="age" class="form-control" value="{{ old('age') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Gender *</label>
                        <select name="gender" class="form-control">
                            <option value="">Select</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Blood Group</label>
                        <input type="text" name="blood_group" class="form-control">
                    </div>

                    <div class="form-group col-md-12 mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control"></textarea>
                    </div>

                </div>
                <button class="btn btn-success px-4">Save Patient</button>
            </form>
        </div>
    </div>
@stop
