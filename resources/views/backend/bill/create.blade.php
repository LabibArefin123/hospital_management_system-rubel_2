@extends('adminlte::page')

@section('title', 'Create Bill')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Create Bill</h3>
        <a href="{{ route('bills.index') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('bills.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="form-group col-md-6">
                        <label>Patient *</label>
                        <select name="patient_id" class="form-control">
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6 ">
                        <label>Consultation Fee</label>
                        <input type="number" name="consultation_fee" class="form-control">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label>Medicine Charge</label>
                        <input type="number" name="medicine_charge" class="form-control">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label>Test Charge</label>
                        <input type="number" name="test_charge" class="form-control">
                    </div>

                </div>
                <button class="btn btn-success px-4">Generate Bill</button>
            </form>
        </div>
    </div>
@stop
