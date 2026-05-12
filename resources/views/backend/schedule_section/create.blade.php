@extends('adminlte::page')

@section('title', 'Create Schedule')

@section('content_header')
    <h1 class="font-weight-bold">
        <i class="fas fa-calendar-plus text-primary"></i>
        Create Schedule
    </h1>
@stop

@section('content')
    <div class="card shadow border-0">
        <form action="{{ route('doctor-schedules.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Select Doctor</label>
                            <select name="doctor_id" class="form-control" required>
                                <option value="">
                                    Choose Doctor
                                </option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">
                                        Dr. {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Time</label>
                            <input type="time" name="time" class="form-control" required>
                        </div>
                    </div>

                </div>

                <div class="form-group">

                    <label>Status</label>

                    <select name="is_booked" class="form-control">

                        <option value="0">
                            Available
                        </option>

                        <option value="1">
                            Booked
                        </option>

                    </select>

                </div>

            </div>

            <div class="card-footer bg-white text-right">

                <button type="submit" class="btn btn-primary px-5">

                    <i class="fas fa-save"></i>
                    Save Schedule

                </button>

            </div>

        </form>

    </div>

@stop
