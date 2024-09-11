@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Apply for the Job</h2>
    <form action="{{route('application.store')}}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" id="name" name="name">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone">
            @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="coverLetter">Cover Letter</label>
            <textarea class="form-control" id="coverLetter" name="cover_letter" rows="4"></textarea>
            @error('cover_letter')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input type="hidden" name="job_id" value="{{ $job->job_id }}">
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </div>

    </form>
</div>
@endsection
