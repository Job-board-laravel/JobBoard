<!-- resources/views/candidate/all_application.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Applications</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Job Title</th>
                <th>Applied At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $application)
                <tr>
                    <td>{{ $application->application_id }}</td>
                    <td>
                        {{$application->AppJob->title}}
                    </td>
                    <td>{{ $application->applied_at }}</td>
                    <td>{{ $application->status }}</td>
                    <td>
                        <!-- Show Button -->
                        <a href="{{ route('application.show', $application) }}" class="btn btn-primary">Show</a>

                        <!-- Edit Button -->
                        <a href="{{ route('application.edit', $application) }}" class="btn btn-warning">Edit</a>

                        <!-- Delete Button -->
                        @if ($application->trashed())
                            <form action="{{ route('application.restore', $application->application_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                        @else
                            <form action="{{ route('application.destroy', $application->application_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(this)">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No applications found for your account.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

<script>
    function confirmDelete(button) {
        if (confirm('Are you sure you want to delete this job?')) {
            button.closest('form').submit();
        } else {
            return false;
        }
    }
</script>
