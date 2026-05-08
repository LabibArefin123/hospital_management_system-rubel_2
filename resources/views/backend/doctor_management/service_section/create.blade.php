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
                    <label>Instructions</label>
                    <input type="text" name="instructions[]" class="form-control mb-2">
                    <input type="text" name="instructions[]" class="form-control mb-2">
                    <input type="text" name="instructions[]" class="form-control">
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
