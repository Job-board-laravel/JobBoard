@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-4">Application Details</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <p><strong>User Name:</strong> {{ $application->CandidateFillApp->name }}</p>
                    <p><strong>Resume:</strong> <a href="{{ asset('storage/' . $application->resume) }}" target="_blank">Download Resume</a></p>
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
