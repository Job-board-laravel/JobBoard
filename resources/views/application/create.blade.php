@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Apply for the Job</h2>
    <form action="{{route('application.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="full_name" required>
        </div>

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>

        <!-- <div class="form-group">
            <label for="resume">Resume (PDF only)</label>
            <input type="file" class="form-control-file" id="resume" name="resume" accept=".pdf" required>
        </div> -->

        <div class="form-group">
            <label for="coverLetter">Cover Letter</label>
            <textarea class="form-control" id="coverLetter" name="cover_letter" rows="4" required></textarea>
        </div>

        <input type="hidden" name="job_id" value="{{ $job->job_id }}">
        <button type="submit" class="btn btn-primary">Submit Application</button>
    </form>
</div>
@endsection