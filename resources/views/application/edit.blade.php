@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Application</h1>

    <form action="{{ route('application.update', $application->application_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Job Title (read-only) -->
        <div class="mb-3">
            <label for="name" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="name" value="{{ $application->name }}" name="name">
        </div>

        <!-- Applicant Name (read-only) -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" value="{{ $application->email }}" name="email">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" value="{{ $application->phone }}" name="phone">
        </div>
        <div class="mb-3">
            <label for="cover_letter">Cover Letter</label>
            <textarea class="form-control" id="cover_letter" name="cover_letter" rows="4">{{ $application->cover_letter}}</textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Application</button>
    </form>
</div>
@endsection
