
@extends('layout.body')


@section('contentCandidate')


@foreach ($jobs as $job)

    <div class="container mt-4">
        <div class="card shadow-sm p-3 mb-4">
            <div class="row align-items-center">
                <div class="col-1">
                    <img src="{{ asset('images/LogoEmployers/'.$job->logo)}}" alt="Company Logo" class="img-fluid rounded" style="width:auto; height:85px; object-fit:cover;">
                </div>
                <div class="col-10">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="#" class="text-decoration-none text-primary fw-bold">{{$job->title}}</a>
                        </div>
                    </div>
                    <div class="text-muted">
                        <span>{{$job->EmployeeCreateJob->name}}</span> <br>
                        <span>{{ $job->location }} ({{$job->work_type}})</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
