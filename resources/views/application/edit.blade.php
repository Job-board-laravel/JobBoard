@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Application</h1>

    <form action="{{ route('application.update', $application->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Job Title (read-only) -->
        <div class="mb-3">
            <label for="jobTitle" class="form-label">Job Title</label>
            <input type="text" class="form-control" id="jobTitle" value="{{ $application->job->title }}" readonly>
        </div>

        <!-- Applicant Name (read-only) -->
        <div class="mb-3">
            <label for="applicantName" class="form-label">Applicant Name</label>
            <input type="text" class="form-control" id="applicantName" value="{{ $application->user->name }}" readonly>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="Pending" {{ $application->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ $application->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Rejected" {{ $application->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Application</button>
    </form>
</div>
@endsection
