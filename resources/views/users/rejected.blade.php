<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rejected Jobs</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Work Type</th>
                <th>Salary Range</th>
                <th>Employer Name</th>
                <th>Category Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rejectedJobs as $job)
            <tr>
                <td>{{ $job->title }}</td>
                <td>{{ $job->location }}</td>
                <td>{{ $job->work_type }}</td>
                <td>{{ $job->salary_range }}</td>
                <td>{{ $job->user_name }}</td>
                <td>{{ $job->category_name }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$rejectedJobs->links()}}
@endsection
