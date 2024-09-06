@extends('layout.body')

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
                            <img src="{{ asset('images/LogoEmployers/'.$job->logo)}}" alt="{{ $job->title }} Logo" style="width:100px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $job->stutas }}</td>
                    <td>
                    <a href="{{ route('employer.show', $job->job_id) }}" class="btn btn-info btn-sm" title="View Job">View</a>
                    <a href="{{ route('employer.edit', $job->job_id) }}" class="btn btn-warning btn-sm">Edit Job</a>
                    <form action="{{ route('employer.destroy', 'job') }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Job" onclick="return confirm('Are you sure you want to delete this job?')">Delete</button>
                        </form>
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
