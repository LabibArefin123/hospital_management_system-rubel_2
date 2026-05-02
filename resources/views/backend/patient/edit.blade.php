@extends('adminlte::page')

@section('title', 'Edit Patient')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Patient</h3>
        <a href="{{ route('patients.index') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="form-group col-md-6">
                        <label>Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $patient->name) }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Age *</label>
                        <input type="number" name="age" class="form-control" value="{{ old('age', $patient->age) }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Gender *</label>
                        <select name="gender" class="form-control">
                            @foreach (['Male', 'Female', 'Other'] as $gender)
                                <option value="{{ $gender }}" {{ $patient->gender == $gender ? 'selected' : '' }}>
                                    {{ $gender }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone', $patient->phone) }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Blood Group</label>
                        <input type="text" name="blood_group" class="form-control"
                            value="{{ old('blood_group', $patient->blood_group) }}">
                    </div>

                    <div class="form-group col-md-12 mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control">{{ old('address', $patient->address) }}</textarea>
                    </div>

                </div>

                <button class="btn btn-success px-4">Update Patient</button>
            </form>
        </div>
    </div>
@stop
