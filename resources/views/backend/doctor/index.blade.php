@extends('adminlte::page')

@section('title', 'Doctors')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1>Doctor List</h1>
        <a href="{{ route('doctors.create') }}" class="btn btn-success btn-sm">
            + Add Doctor
        </a>
    </div>
@stop

@section('content')
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover text-nowrap" id="dataTables">
                <thead>
                    <tr>
                        <th class="text-center">SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Specialization</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doctors as $doctor)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->email }}</td>
                            <td>{{ $doctor->phone }}</td>
                            <td>{{ $doctor->specialization }}</td>
                            <td>
                                <span class="badge {{ $doctor->is_available ? 'bg-success' : 'bg-danger' }}">
                                    {{ $doctor->is_available ? 'Available' : 'Unavailable' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-sm btn-warning">Show</a>
                                <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this doctor?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No doctors found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
