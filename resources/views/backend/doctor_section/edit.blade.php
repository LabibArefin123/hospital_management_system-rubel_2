@extends('adminlte::page')

@section('title', 'Edit Doctor')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3>Edit Doctor</h3>

        <a href="{{ route('doctors.index') }}" class="back-btn btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
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
                            <div class="col-md-4 te<div class="text-center">

                                @if ($doctor->image)
                                    <img src="{{ $doctor->image ? asset($doctor->image) : asset('uploads/images/default.jpg') }}"
                                        class="img-circle elevation-3 mb-3 doctor-preview-image" id="doctorPreviewImage"
                                        width="180" height="180" style="object-fit: cover;">
                                @endif

                                <div class="form-group">

                                    <label class="font-weight-bold">
                                        Update Image
                                    </label>

                                    <div class="custom-file">

                                        <input type="file" name="image" class="custom-file-input" id="doctorImageInput"
                                            accept="image/*">

                                        <label class="custom-file-label">
                                            Choose Image
                                        </label>

                                    </div>

                                </div>

                                {{-- IMAGE INFORMATION --}}
                                <div class="card shadow-sm mt-3">

                                    <div class="card-body text-left">

                                        <h6 class="font-weight-bold text-primary mb-3">
                                            <i class="fas fa-image"></i>
                                            Image Information
                                        </h6>

                                        <ul class="list-group">

                                            <li class="list-group-item">
                                                <strong>File Name:</strong>
                                                <span id="imageFileName">N/A</span>
                                            </li>

                                            <li class="list-group-item">
                                                <strong>File Size:</strong>
                                                <span id="imageFileSize">N/A</span>
                                            </li>

                                            <li class="list-group-item">
                                                <strong>Dimensions:</strong>
                                                <span id="imageDimensions">N/A</span>
                                            </li>

                                            <li class="list-group-item">
                                                <strong>Format:</strong>
                                                <span id="imageFormat">N/A</span>
                                            </li>

                                            <li class="list-group-item">
                                                <strong>Shape:</strong>
                                                <span id="imageShape">N/A</span>
                                            </li>

                                        </ul>

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
                                            <input type="text" name="total_patients"
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
