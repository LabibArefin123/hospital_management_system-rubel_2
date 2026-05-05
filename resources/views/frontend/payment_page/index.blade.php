@extends('frontend.layouts.app')

@section('content')
    <div class="container py-5">
        <h3>Online Payment</h3>

        <div class="card p-4">
            <p><strong>Doctor:</strong> {{ $appointment->doctor->name }}</p>
            <p><strong>Amount:</strong> {{ $appointment->amount }} BDT</p>

            <hr>

            <label>Card Number</label>
            <input type="text" class="form-control mb-2">

            <label>Expiry</label>
            <input type="text" class="form-control mb-2">

            <label>CVV</label>
            <input type="text" class="form-control mb-3">

            <button class="btn btn-success w-100">Pay Now (Demo)</button>
        </div>
    </div>
@endsection
