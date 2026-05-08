@extends('adminlte::page')

@section('title', 'Service Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3>Service Detail</h3>
        <div>
            <a href="{{ route('services.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
@stop

@section('content')

    <div class="card shadow">

        <div class="card-body">

            <img src="{{ asset($service->image) }}" width="250" class="mb-4">

            <h3>{{ $service->title }}</h3>

            <p>{{ $service->description }}</p>

            <h4>৳ {{ number_format($service->price, 2) }}</h4>

            <hr>

            <h5>Instructions</h5>

            <ul>
                @foreach ($service->instructions as $instruction)
                    <li>{{ $instruction }}</li>
                @endforeach
            </ul>

        </div>

    </div>
@stop
    