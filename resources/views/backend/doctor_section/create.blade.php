@extends('adminlte::page')

@section('title', 'Create Doctor')

@section('content_header')
    <h1 class="font-weight-bold text-dark">
        <i class="fas fa-user-md text-primary"></i>
        Add New Doctor
    </h1>
@stop

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card shadow border-0">

                <div class="card-header bg-white">
                    <h3 class="card-title font-weight-bold">
                        Doctor Information
                    </h3>
                </div>

                <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Doctor Name</label>

                                    <input type="text" name="name" class="form-control"
                                        placeholder="Enter doctor name">
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Speciality</label>

                                    <input type="text" name="speciality" class="form-control"
                                        placeholder="Cardiology, Neurology...">
                                </div>

                            </div>




                        </div>

                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>Success Rate (%)</label>

                                    <input type="number" name="success_rate" class="form-control" placeholder="95">
                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>Experience Years</label>

                                    <input type="number" name="experience_years" class="form-control" placeholder="10">
                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>Total Patients</label>

                                    <input type="number" name="total_patients" class="form-control" placeholder="5000">
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Qualification</label>

                                    <input type="text" name="qualification" class="form-control"
                                        placeholder="MBBS, FCPS">
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Location</label>

                                    <input type="text" name="location" class="form-control"
                                        placeholder="Dhaka Medical Center">
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Consultation Fee</label>

                                    <input type="number" step="0.01" name="consultation_fee" class="form-control"
                                        placeholder="1000">
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Availability</label>

                                    <select name="availability" class="form-control">

                                        <option value="Available">
                                            Available
                                        </option>

                                        <option value="Unavailable">
                                            Unavailable
                                        </option>

                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="form-group">

                            <label>About Doctor</label>

                            <textarea name="about" rows="5" class="form-control" placeholder="Write doctor profile..."></textarea>

                        </div>

                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>Doctor Email</label>

                                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>Doctor Username</label>

                                    <input type="text" name="username" class="form-control" placeholder="Enter username">
                                </div>

                            </div>

                            <div class="col-md-4 ">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control">
                                    <button type="button" class="btn btn-outline-secondary toggle-password"
                                        data-target="password">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">

                            <label>Doctor Image</label>

                            <div class="custom-file">

                                <input type="file" name="image" class="custom-file-input" id="doctorImage">

                                <label class="custom-file-label" for="doctorImage">

                                    Choose file

                                </label>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer bg-white text-right">

                        <button type="submit" class="btn btn-primary px-5">

                            <i class="fas fa-save"></i>
                            Save Doctor

                        </button>

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
