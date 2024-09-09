@extends('layouts.app')

@section('content')
<h1>{{ $job->title }}</h1>

<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center" style="font-size:1.5em">
            <div class="col-1">
                @if ($job->logo)
                <img src="{{ asset('images/LogoEmployers/'.$job->logo)}}" alt="Company Logo" class="img-fluid rounded" style="width:auto; height:85px; object-fit:cover;">
                @else
                <p>No Logo Available</p>
                @endif
            </div>
            <div class="col-10">
                <div class="d-flex justify-content-between">
                    <div>
                        <span>{{$job->EmployeeCreateJob->name}}</span> <br>
                    </div>
                </div>
                <div class="text-muted">
                    <span style="font-size: 30px">{{$job->title}}</span>
                    <br><span>{{ $job->location }} ({{$job->work_type}})</span>
                </div>
            </div>
            <div class="text-muted">
                <span style="font-size: 30px"><a href="#" class="text-decoration-none text-primary fw-bold">{{$job->title}}</a></span>
                <br><span>{{ $job->location }} ({{$job->work_type}})</span>
            </div>
        </div>

    </div>
    <div class="card-body">
        <p><strong>Description:</strong> {{ $job->description }}</p>
        <p><strong>Requirements:</strong> {{ $job->requirement }}</p>
        <p><strong>Benefits:</strong> {{ $job->benefit }}</p>
        <p><strong>Application Deadline:</strong> {{ $job->application_deadline }}</p>
        <p><strong>Contact Info:</strong> {{ $job->contact_info }}</p>
        <p><strong>Technologies:</strong> {{ $job->technologies }}</p>
        <p><strong>Salary Range:</strong> {{ $job->salary_range }}</p>

        <br>
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
<div class="crud-footer  d-flex justify-content-around ">
    <a href="{{ route('employer.index') }}" class="btn btn-primary">Back to Jobs</a>
    <a href="{{ route('application.createApp', ["job_id"=> $job->job_id] )}}" class="btn btn-primary">apply</a>
</div>



@endsection
