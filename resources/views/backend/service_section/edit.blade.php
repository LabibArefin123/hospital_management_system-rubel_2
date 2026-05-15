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

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <label class="mb-0">

                            Instructions

                        </label>

                        <button type="button" id="addInstructionBtn" class="btn btn-sm btn-success">

                            <i class="fas fa-plus"></i>

                        </button>

                    </div>

                    <div id="instructionWrapper">

                        {{-- OLD INSTRUCTIONS --}}
                        @forelse ($service->instructions as $instruction)
                            <div class="instruction-item mb-2">

                                <div class="input-group">

                                    <input type="text" name="instructions[]" value="{{ $instruction }}"
                                        class="form-control" placeholder="Enter instruction">

                                    <div class="input-group-append">

                                        <button type="button" class="btn btn-danger removeInstructionBtn">

                                            <i class="fas fa-minus"></i>

                                        </button>

                                    </div>

                                </div>

                            </div>

                        @empty

                            {{-- DEFAULT INPUT --}}
                            <div class="instruction-item mb-2">

                                <div class="input-group">

                                    <input type="text" name="instructions[]" class="form-control"
                                        placeholder="Enter instruction">

                                    <div class="input-group-append">

                                        <button type="button" class="btn btn-danger removeInstructionBtn">

                                            <i class="fas fa-minus"></i>

                                        </button>

                                    </div>

                                </div>

                            </div>
                        @endforelse

                    </div>

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
@section('js')
    <script src="{{ asset('js/custom_backend/service_section/edit_page/instruction-repeat.js') }}"></script>
@stop