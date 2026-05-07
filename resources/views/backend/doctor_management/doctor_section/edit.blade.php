@extends('adminlte::page')

@section('title', 'Edit Doctor')

@section('content_header')
    <h1 class="font-weight-bold">
        <i class="fas fa-user-edit text-warning"></i>
        Edit Doctor
    </h1>
@stop

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h3 class="card-title font-weight-bold">
                        Update Doctor Information
                    </h3>

                </div>

                <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4 text-center">

                                @if ($doctor->image)
                                    <img src="{{ asset($doctor->image) }}" class="img-circle elevation-3 mb-3"
                                        width="180" height="180" style="object-fit: cover;">
                                @endif

                                <div class="form-group">

                                    <label class="font-weight-bold">
                                        Update Image
                                    </label>

                                    <div class="custom-file">

                                        <input type="file" name="image" class="custom-file-input">

                                        <label class="custom-file-label">
                                            Choose Image
                                        </label>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-8">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Doctor Name</label>

                                            <input type="text" name="name" value="{{ $doctor->name }}"
                                                class="form-control">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Speciality</label>

                                            <input type="text" name="speciality" value="{{ $doctor->speciality }}"
                                                class="form-control">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label>Success Rate</label>

                                            <input type="number" name="success_rate" value="{{ $doctor->success_rate }}"
                                                class="form-control">

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label>Experience</label>

                                            <input type="number" name="experience_years"
                                                value="{{ $doctor->experience_years }}" class="form-control">

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label>Total Patients</label>

                                            <input type="number" name="total_patients"
                                                value="{{ $doctor->total_patients }}" class="form-control">

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Qualification</label>

                                    <input type="text" name="qualification" value="{{ $doctor->qualification }}"
                                        class="form-control">

                                </div>

                                <div class="form-group">

                                    <label>Location</label>

                                    <input type="text" name="location" value="{{ $doctor->location }}"
                                        class="form-control">

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Consultation Fee</label>

                                            <input type="number" name="consultation_fee"
                                                value="{{ $doctor->consultation_fee }}" class="form-control">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Availability</label>

                                            <select name="availability" class="form-control">

                                                <option value="Available"
                                                    {{ $doctor->availability == 'Available' ? 'selected' : '' }}>
                                                    Available
                                                </option>

                                                <option value="Unavailable"
                                                    {{ $doctor->availability == 'Unavailable' ? 'selected' : '' }}>
                                                    Unavailable
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>About Doctor</label>

                                    <textarea name="about" rows="5" class="form-control">{{ $doctor->about }}</textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer bg-white text-right">

                        <button type="submit" class="btn btn-warning px-5">

                            <i class="fas fa-save"></i>
                            Update Doctor

                        </button>

                        <a href="{{ route('doctors.index') }}" class="btn btn-secondary px-4">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@stop

@section('js')

    <script>
        bsCustomFileInput.init();
    </script>

@stop
