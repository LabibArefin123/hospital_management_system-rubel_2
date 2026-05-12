@extends('adminlte::page')

@section('title', 'Edit Service')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3>Edit Service</h3>

        <a href="{{ route('services.index') }}" class="back-btn btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
@stop


@section('content')

    <div class="card shadow">

        <form method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ old('title', $service->title) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" value="{{ old('price', $service->price) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Instructions</label>

                    @foreach ($service->instructions as $instruction)
                        <input type="text" name="instructions[]" value="{{ $instruction }}" class="form-control mb-2">
                    @endforeach

                </div>

                <div class="mb-3">
                    <img src="{{ asset($service->image) }}" width="120">
                </div>

                <div class="form-group">
                    <label>Change Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-warning">Update</button>
            </div>

        </form>

    </div>
@stop
