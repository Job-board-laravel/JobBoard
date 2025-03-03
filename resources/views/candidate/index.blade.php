@extends('layouts.app')

@section('contentCandidate')

    <div class="container-fluid w-100 d-flex col-4">
        <!-- Sidebar for search filters -->
        <div class="navbar navbar-light w-25  h-100  ">
            <!-- <h1 class="bg-light text-center w-100 card-header rounded-5">Search</h1> position-absolute top-0 start-0-->


            <div class="w-100 m-1 rounded-5">
                <h1 class="title w-100 rounded-5">Category</h1>
                <select class="form-select" name="category_name" aria-label="select Category">
                    <option disabled selected>select Category</option>
                    @foreach ($categories as $category )
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-100 m-2 rounded-5">
                <h1 class="title  w-100 rounded-5">Salary</h1>
                <input class="form-control me-2" type="number" name="minSalary" placeholder="Min Salary" value="{{ @$searchTerm }}" aria-label="Minimum Salary">
                <input class="form-control me-2" type="number" name="maxSalary" placeholder="Max Salary" value="{{ @$searchTerm }}" aria-label="Maximum Salary">
            </div>
            <div class="w-100 m-2 rounded-5">
                <h1 class="title  w-100 rounded-5">Date Posted</h1>
                <input class="form-control me-2" type="date" name="job_created" placeholder="Date Posted" value="{{ @$searchTerm }}" aria-label="Date Posted">
            </div>

            <form class="d-flex w-100 m-1 rounded-5 justify-content-end" method="get" action="/search">
                @csrf
                <!-- <input class="form-control me-2" type="search" name="search" placeholder="Search" value="{{ @$searchTerm }}" aria-label="Search"> -->
                <button class="btn btn-outline-success " type="submit">Search</button>
            </form>
        </div>

        <!-- Main content area for job listings position-absolute top-0 end-0 -->
        <div class="w-75 col-8 mb-5" >
            <nav class="navbar">
                <div class="container-fluid">
                    <h1>All Jobs</h1>
                    <form class="d-flex" method="get" action="/search">
                        @csrf
                        <input class="form-control me-2" type="search" name="search" placeholder="Search" value="{{ @$searchTerm }}" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </nav>

            @foreach ($jobs as $job)
                <div class="container mt-4">
                    <div class="card shadow-sm p-3 mb-4">
                        <div class="row align-items-center">
                            <div class="col-1">
                                <img src="{{ asset('images/LogoEmployers/' . $job->logo) }}" alt="Company Logo"
                                class="img-fluid rounded" style="width:auto; height:85px; object-fit:cover;">
                            </div>
                            <div class="col-10">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('candidate.show', $job->job_id) }}" class="text-decoration-none text-primary fw-bold">{{ $job->title }}</a>
                                    </div>
                                </div>
                                <div class="text-muted mt-2">
                                    <span>{{ $job->EmployeeCreateJob->name }}</span> <br>
                                    <span>{{ $job->location }} ({{ $job->work_type }})</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{$jobs->links()}}

@endsection
