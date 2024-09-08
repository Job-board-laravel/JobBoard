@extends('layouts.app')

@section('content')
    <h1>Create Job</h1>

    <form action="{{ route('employer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Job Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="requirement" class="form-label">Requirements</label>
            <textarea class="form-control" id="requirement" name="requirement" required></textarea>
        </div>
        <div class="mb-3">
            <label for="benefit" class="form-label">Benefits</label>
            <textarea class="form-control" id="benefit" name="benefit" required></textarea>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="mb-3">
            <label for="technologies" class="form-label">Technologies</label>
            <input type="text" class="form-control" id="technologies" name="technologies" required>
        </div>
        <div class="mb-3">
            <label for="work_type" class="form-label">Work Type</label>
            <select class="form-select" id="work_type" name="work_type" required>
                <option value="remote">Remote</option>
                <option value="onsite">Onsite</option>
                <option value="hybrid">Hybrid</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="salary_range" class="form-label">Salary Range</label>
            <input type="number" class="form-control" id="salary_range" name="salary_range">
        </div>
        <div class="mb-3">
            <label for="application_deadline" class="form-label">Application Deadline</label>
            <input type="date" class="form-control" id="application_deadline" name="application_deadline" required>
        </div>
        <div class="mb-3">
            <label for="contact_info" class="form-label">Contact Info</label>
            <input type="text" class="form-control" id="contact_info" name="contact_info">
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Company Logo</label>
            <input type="file" class="form-control" id="logo" name="logo">
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Job</button>
    </form>
@endsection
