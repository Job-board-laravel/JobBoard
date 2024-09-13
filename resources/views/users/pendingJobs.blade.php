<!-- resources/views/pending-jobs.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h1>Pending Jobs</h1>
    @if($pendingJobs->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Work Type</th>
                    <th>Salary Range</th>
                    <th>User Name</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingJobs as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->location }}</td>
                    <td>{{ $job->work_type }}</td>
                    <td>{{ $job->salary_range }}</td>
                    <td>{{ $job->user_name }}</td>
                    <td>{{ $job->category_name }}</td>
                    <td>
                        <form action="{{ route('update.job.status', $job->job_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" name="status" value="Approve" class="btn btn-success btn-sm">Accept</button>
                            <button type="submit" name="status" value="Reject" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1 style="margin: auto 20%">NO New Job</h1>
    @endif
</div>
{{$pendingJobs->links()}}


@endsection
