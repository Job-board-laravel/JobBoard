@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-4">Application Details</h1>
            <div class="card mb-4">
                <div class="card-body">
                    @if($application->status == "Accepted")
                        <h2 style="font-weight: 900;font-size: 40px; color:green;">{{$application->status}}</h2>
                    @elseif($application->status == "Rejected")
                        <h2 style="font-weight: 900;font-size: 40px; color:red;">{{$application->status}}</h2>
                    @else
                        <h2 style="font-weight: 900;font-size: 30px; color:yellow;">{{$application->status}}</h2>
                    @endif
                    <p><strong>Full Name:</strong> {{ $application->CandidateFillApp->name }}</p>
                    <p><strong>Email address:</strong> {{ $application->email }}</p>
                    <p><strong>Phone Number:</strong> {{ $application->phone }}</p>
                    <p><strong>Cover Letter:</strong> {{ $application->cover_letter }}</p>
                </div>
            </div>

            @if(auth()->check() && auth()->user()->role === 'Employer')
                <div class="mt-4">
                    <form action="{{ route('applications.accept', $application->application_id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Accept</button>
                    </form>
                    <form action="{{ route('applications.reject', $application->application_id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
