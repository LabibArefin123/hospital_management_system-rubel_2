@extends('adminlte::page')

@section('title', 'Bills')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1>Bill List</h1>
        <a href="{{ route('bills.create') }}" class="btn btn-success btn-sm">
            + Create Bill
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
                        <th>Patient</th>
                        <th>Consultation</th>
                        <th>Medicine</th>
                        <th>Test</th>
                        <th>Total</th>
                        <th class="text-center" style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bills as $bill)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $bill->patient->name }}</td>
                            <td>{{ $bill->consultation_fee }}</td>
                            <td>{{ $bill->medicine_charge }}</td>
                            <td>{{ $bill->test_charge }}</td>
                            <td class="fw-bold text-success">{{ $bill->total_amount }}</td>
                            <td class="text-center">
                                <a href="{{ route('bills.show', $bill->id) }}" class="btn btn-sm btn-warning">Show</a>
                                <a href="{{ route('bills.edit', $bill->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('bills.destroy', $bill->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this bill?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No bills found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
