<!-- resources/views/candidate/all_application.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Applications</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cover Letter</th>
                <th>Status</th>
                <th>Applied At</th>
                <th>Job Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $application)
                <tr>
                    <td>{{ $application->application_id }}</td>
                    <td>{{ $application->cover_letter }}</td>
                    <td>{{ $application->status }}</td>
                    <td>{{ $application->applied_at }}</td>
                    <td>
                      {{$application->AppJob->title}}

                    </td>
                    <td>
                        <!-- Show Button -->
                        <a href="{{ route('applications.show', $application->application_id) }}" class="btn btn-primary">Show</a>

                        <!-- Edit Button -->
                        <a href="{{ route('applications.edit', $application->application_id) }}" class="btn btn-warning">Edit</a>

                        <!-- Delete Button -->
                        <form action="{{ route('applications.destroy', $application->application_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
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
