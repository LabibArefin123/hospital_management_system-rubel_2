@extends('adminlte::page')

@section('title', 'Edit Bill')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Edit Bill</h3>
        <a href="{{ route('bills.index') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('bills.update', $bill->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="form-group col-md-6">
                        <label>Patient *</label>
                        <select name="patient_id" class="form-control">
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}"
                                    {{ $bill->patient_id == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6 ">
                        <label>Consultation Fee</label>
                        <input type="number" name="consultation_fee" class="form-control"
                            value="{{ $bill->consultation_fee }}">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label>Medicine Charge</label>
                        <input type="number" name="medicine_charge" class="form-control"
                            value="{{ $bill->medicine_charge }}">
                    </div>

                    <div class="form-group col-md-6 ">
                        <label>Test Charge</label>
                        <input type="number" name="test_charge" class="form-control" value="{{ $bill->test_charge }}">
                    </div>

                </div>

                <button class="btn btn-success px-4">Update Bill</button>
            </form>
        </div>
    </div>
@stop
