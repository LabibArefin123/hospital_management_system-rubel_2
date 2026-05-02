@extends('adminlte::page')

@section('title', 'Bill Information')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Bill Details</h1>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label>Patient</label>
                        <input type="text" class="form-control" value="{{ $bill->patient->name }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Consultation Fee</label>
                        <input type="text" class="form-control" value="{{ number_format($bill->consultation_fee, 2) }}"
                            readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Medicine Charge</label>
                        <input type="text" class="form-control" value="{{ number_format($bill->medicine_charge, 2) }}"
                            readonly>
                    </div>

                    <div class="col-md-6">
                        <label>Test Charge</label>
                        <input type="text" class="form-control" value="{{ number_format($bill->test_charge, 2) }}"
                            readonly>
                    </div>

                    <div class="col-md-12">
                        <label>Total Amount</label>
                        <input type="text" class="form-control fw-bold text-success"
                            value="{{ number_format($bill->total_amount, 2) }}" readonly>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
