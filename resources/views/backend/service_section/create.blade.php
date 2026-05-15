@extends('adminlte::page')

@section('title', 'Create Service')

@section('content')

    <div class="card shadow">

        <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data">

            @csrf

            <div class="card-body">

                {{-- ERRORS --}}
                @if ($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif

                {{-- TITLE --}}
                <div class="form-group">

                    <label>Title</label>

                    <input type="text" name="title" value="{{ old('title') }}"
                        class="form-control @error('title') is-invalid @enderror">

                    @error('title')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                {{-- DESCRIPTION --}}
                <div class="form-group">

                    <label>Description</label>

                    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>

                    @error('description')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                {{-- PRICE --}}
                <div class="form-group">

                    <label>Price</label>

                    <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                        class="form-control @error('price') is-invalid @enderror">

                    @error('price')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                {{-- INSTRUCTIONS --}}
                <div class="form-group">

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <label class="mb-0">

                            Instructions

                        </label>

                        <button type="button" id="addInstructionBtn" class="btn btn-success btn-sm">

                            <i class="fas fa-plus"></i>

                        </button>

                    </div>

                    <div id="instructionWrapper">

                        @if (old('instructions'))

                            @foreach (old('instructions') as $instruction)
                                <div class="instruction-item mb-2">

                                    <div class="input-group">

                                        <input type="text" name="instructions[]" value="{{ $instruction }}"
                                            class="form-control">

                                        <div class="input-group-append">

                                            <button type="button" class="btn btn-danger removeInstructionBtn">

                                                <i class="fas fa-minus"></i>

                                            </button>

                                        </div>

                                    </div>

                                </div>
                            @endforeach
                        @else
                            <div class="instruction-item mb-2">

                                <div class="input-group">

                                    <input type="text" name="instructions[]" class="form-control">

                                    <div class="input-group-append">

                                        <button type="button" class="btn btn-danger removeInstructionBtn">

                                            <i class="fas fa-minus"></i>

                                        </button>

                                    </div>

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

                {{-- IMAGE --}}
                <div class="form-group">

                    <label class="font-weight-bold">

                        Service Image

                    </label>

                    <br>

                    <button type="button" class="btn btn-primary" id="openImageModal">

                        <i class="fas fa-image mr-1"></i>

                        Upload Image

                    </button>

                    {{-- REAL FILE INPUT --}}
                    <input type="file" name="image" id="doctorImageInput" accept=".jpg,.jpeg,.png,.webp"
                        class="d-none">

                    @error('image')
                        <div class="text-danger mt-2">

                            {{ $message }}

                        </div>
                    @enderror

                    {{-- FINAL PREVIEW --}}
                    <div class="mt-3">

                        <img id="finalPreviewImage" class="img-fluid rounded border d-none" style="max-height:250px;">

                    </div>

                </div>

            </div>

            <div class="card-footer text-right">

                <button type="submit" class="btn btn-success">

                    <i class="fas fa-save mr-1"></i>

                    Save Service

                </button>

            </div>

        </form>

    </div>

    @include('backend.service_section.custom_modal.create_page.image_upload_modal')

    @include('backend.service_section.custom_modal.create_page.replace_upload_modal')

@stop

@section('js')
    <script src="{{ asset('js/custom_backend/service_section/create_page/instruction-repeat.js') }}"></script>
    <script src="{{ asset('js/custom_backend/service_section/create_page/image-validation-modal.js') }}"></script>
@stop
