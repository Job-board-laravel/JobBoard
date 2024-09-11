@extends('layouts.app')

@section('contentCandidate')
<div class="container-fluid d-flex">
    <!-- Sidebar for search filters -->
    <aside class="bg-light p-3 w-25 rounded shadow-sm">
        <h2 class="text-center mb-4">Search Filters</h2>

        <!-- Search Form -->
        <form method="get" action="/search" class="mb-4">
            @csrf
            <div class="mb-3">
                <input type="search" name="search" class="form-control" placeholder="Search by title or location" value="{{ @$searchTerm }}">
            </div>
            <button class="btn btn-primary w-100" type="submit">Search</button>
        </form>

        <!-- Category Filter -->
        <div class="mb-4">
            <h4 class="text-center">Category</h4>
            <select name="cat" class="form-select">
                <option value="" selected>Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Salary Range Filter -->
        <div class="mb-4">
            <h4 class="text-center">Salary Range</h4>
            <div class="mb-2">
                <input type="number" name="minSalary" class="form-control" placeholder="Min Salary">
            </div>
            <div>
                <input type="number" name="maxSalary" class="form-control" placeholder="Max Salary">
            </div>
        </div>

        <!-- Date Posted Filter -->
        <div class="mb-4">
            <h4 class="text-center">Date Posted</h4>
            <input type="date" name="job_created" class="form-control">
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="w-75 ms-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Available Jobs</h1>
            <!-- Search Form in Main Content -->
            <form method="get" action="/search" class="d-flex">
                @csrf
                <input type="search" name="search" class="form-control me-2" placeholder="Search jobs" value="{{ @$searchTerm }}">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>

        <!-- Job Listings -->
        @foreach ($jobs as $job)
        <div class="card shadow-sm p-3 mb-4">
            <div class="row g-0 align-items-center">
                <!-- Company Logo -->
                <div class="col-md-1" style="margin: 0% 3% 0% 0%">
                    <img src="{{ asset('images/LogoEmployers/' . $job->logo) }}" alt="Company Logo" class="img-fluid rounded" style="width:85px; height:85px; object-fit:cover;">
                </div>

                <!-- Job Details -->
                <div class="col-md-10" style="margin: 1.5% 0% 0%; ">
                    <div class="d-flex justify-content-between">
                        <!-- Job Title -->
                        <a href="{{ route('candidate.show', $job->job_id) }}" class="text-decoration-none text-primary fw-bold h3">
                            {{ $job->title }}
                        </a>
                        <!-- Job Type (Remote/Onsite/Hybrid) -->
                        <span class="badge bg-secondary" style="font-size: 20px;">{{ ucfirst($job->work_type) }}</span>
                    </div>
                    <!-- Employer Name and Location -->
                    <p class="mb-1 text-muted">
                        <strong> location: {{ $job->EmployeeCreateJob->name }}</strong>  {{ $job->location }}
                    </p>
                    <!-- Salary Range -->
                    @if($job->salary_range)
                    <p class="text-muted">
                        Salary: ${{ number_format($job->salary_range) }}
                    </p>
                    @endif
                </div>
                <h3>Description</h3>
                <h5>
                    <li>{{$job->description}}</li>
                </h5>
            </div>
        </div>
        @endforeach
        {{$jobs->links()}}

        <!-- Pagination Links (if necessary) -->
        {{-- <div class="mt-4">
            {{ $jobs->links() }}
        </div> --}}
    </div>
</div>
@endsection
