@extends('layout.body')

@section('content')
    <h1>{{ $job->title }}</h1>

    <div class="card mb-3">
        <div class="card-header">
            <h3>{{ $job->title }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Location:</strong> {{ $job->location }}</p>
            <p><strong>Work Type:</strong> {{ $job->work_type }}</p>
            <p><strong>Description:</strong> {{ $job->description }}</p>
            <p><strong>Requirements:</strong> {{ $job->requirement }}</p>
            <p><strong>Benefits:</strong> {{ $job->benefit }}</p>
            <p><strong>Application Deadline:</strong> {{ $job->application_deadline }}</p>
            <p><strong>Contact Info:</strong> {{ $job->contact_info }}</p>
            <p><strong>Technologies:</strong> {{ $job->technologies }}</p>
            <p><strong>Salary Range:</strong> {{ $job->salary_range }}</p>
            @if ($job->logo)
                <p><strong>Logo:</strong></p>
                <img src="{{ asset('images/LogoEmployers/' . $job->logo) }}" alt="{{ $job->title }} Logo" style="width: 150px;">
            @else
                <p>No Logo Available</p>
            @endif
            <br><br><br>
            <p><strong>Status:</strong> {{ $job->stutas }}</p>

            <p><strong>Category:</strong>
            @if ($job->jobCategory)
                {{ $job->jobCategory->category_name }}
            @else
                Category not available
            @endif
            </p>
        </div>
    </div>

    <a href="{{ route('employer.index') }}" class="btn btn-primary">Back to Jobs</a>
@endsection
