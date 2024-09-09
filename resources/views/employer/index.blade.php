@extends('layouts.app')

@section('content')
    <h1>All Jobs</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Work Type</th>
                <th>Logo</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jobs as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->location }}</td>
                    <td>{{ $job->work_type }}</td>
                    <td>
                        @if ($job->logo)
                            <img class="imgEmp"src="{{ asset('images/LogoEmployers/'.$job->logo)}}"
                            alt="{{ $job->title }} Logo" style="width:100px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $job->stutas }}</td>
                    <td>
    <!-- Show and Edit Buttons -->
        <a href="{{ route('employer.show', $job->job_id) }}" class="btn btn-info btn-sm" title="View Job">View</a>
        <a href="{{ route('employer.edit', $job->job_id) }}" class="btn btn-warning btn-sm">Edit Job</a>

    <!-- Check if the job is soft-deleted -->
    @if ($job->trashed())
        <!-- Restore Button for Soft-Deleted Jobs -->
        <form action="{{ route('employer.restore', $job->job_id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success btn-sm">Restore</button>
        </form>
    @else
        <!-- Delete Button for Active Jobs -->
        <form action="{{ route('employer.destroy', $job->job_id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(this)">Delete</button>
        </form>
    @endif

    <!-- JavaScript for Delete Confirmation -->
    <script>
        function confirmDelete(button) {
            if (confirm('Are you sure you want to delete this job?')) {
                button.closest('form').submit();
            } else {
                return false;
            }
        }
    </script>
</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No jobs available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
