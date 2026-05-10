@extends('adminlte::page')

@section('title', 'Contact Messages')

@section('content_header')
    <h1 class="font-weight-bold">
        Contact Messages
    </h1>
@stop

@section('content')

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <h3 class="card-title font-weight-bold">
                    All Messages
                </h3>

                <span class="badge badge-primary p-2">
                    Total: {{ $contacts->count() }}
                </span>

            </div>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="bg-light">

                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th width="140">Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($contacts as $key => $contact)
                        <tr>

                            <td>{{ $key + 1 }}</td>

                            <td>
                                <strong>{{ $contact->name }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ $contact->email ?? 'No Email' }}
                                </small>
                            </td>

                            <td>{{ $contact->phone }}</td>

                            <td>
                                {{ $contact->department ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $contact->service ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $contact->created_at->format('d M Y') }}
                            </td>

                            <td>

                                <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this message?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                No messages found
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">
                {{ $contacts->links() }}
            </div>

        </div>

    </div>

@stop
