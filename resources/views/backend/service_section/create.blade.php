@extends('adminlte::page')

@section('title', 'Create Service')

@section('content')

    <div class="card shadow">

        <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data">

            @csrf

            <div class="card-body">

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control">
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

                        {{-- INPUT ITEM --}}
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

                       

                    </div>

                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-primary">Save</button>
            </div>

        </form>

    </div>
@stop
@section('js')
    <script src="{{ asset('js/custom_backend/service_section/create_page/instruction-repeat.js') }}"></script>
@stop