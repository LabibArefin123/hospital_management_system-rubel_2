@extends('adminlte::page')

@section('title', 'Edit Doctor')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Doctor</h3>
        <a href="{{ route('doctors.index') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="form-group col-md-6">
                        <label>Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $doctor->email) }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone', $doctor->phone) }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Specialization *</label>
                        <select name="specialization" class="form-control">
                            @foreach (['Cardiologist', 'Neurologist', 'Orthopedic', 'Pediatrician'] as $spec)
                                <option value="{{ $spec }}"
                                    {{ $doctor->specialization == $spec ? 'selected' : '' }}>
                                    {{ $spec }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Status</label>
                        <select name="is_available" class="form-control">
                            <option value="1" {{ $doctor->is_available ? 'selected' : '' }}>Available</option>
                            <option value="0" {{ !$doctor->is_available ? 'selected' : '' }}>Unavailable</option>
                        </select>
                    </div>

                </div>

                <button class="btn btn-success px-4">Update Doctor</button>
            </form>
        </div>
    </div>
@stop
