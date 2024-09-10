@extends('layouts.app')

@section('content')
    <h1>Edit Job</h1>

    <form action="{{ route('employer.update', $job->job_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Job Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $job->title) }}">
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $job->description) }}</textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="requirement" class="form-label">Requirements</label>
            <textarea class="form-control" id="requirement" name="requirement">{{ old('requirement', $job->requirement) }}</textarea>
            @error('requirement')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="benefit" class="form-label">Benefits</label>
            <textarea class="form-control" id="benefit" name="benefit">{{ old('benefit', $job->benefit) }}</textarea>
            @error('benefit')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $job->location) }}">
            @error('location')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="technologies" class="form-label">Technologies</label>
            <input type="text" class="form-control" id="technologies" name="technologies" value="{{ old('technologies', $job->technologies) }}">
            @error('technologies')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="work_type" class="form-label">Work Type</label>
            <select class="form-select" id="work_type" name="work_type">
                <option value="remote" {{ old('work_type', $job->work_type) == 'remote' ? 'selected' : '' }}>Remote</option>
                <option value="onsite" {{ old('work_type', $job->work_type) == 'onsite' ? 'selected' : '' }}>Onsite</option>
                <option value="hybrid" {{ old('work_type', $job->work_type) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
            </select>
            @error('work_type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="salary_range" class="form-label">Salary Range</label>
            <input type="number" class="form-control" id="salary_range" name="salary_range" value="{{ old('salary_range', $job->salary_range) }}">
            @error('salary_range')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="application_deadline" class="form-label">Application Deadline</label>
            <input type="date" class="form-control" id="application_deadline" name="application_deadline" value="{{ old('application_deadline', $job->application_deadline) }}" required>
            @error('application_deadline')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="contact_info" class="form-label">Contact Info</label>
            <input type="text" class="form-control" id="contact_info" name="contact_info" value="{{ old('contact_info', $job->contact_info) }}">
            @error('contact_info')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Company Logo</label>
            <input type="file" class="form-control" id="logo" name="logo">
            @if ($job->logo)
                <p>Current Logo:</p>
                <img src="{{ asset('images/LogoEmployers/' . $job->logo) }}" alt="{{ $job->title }} Logo" style="width: 150px;">
            @endif
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Job</button>
    </form>
@endsection
