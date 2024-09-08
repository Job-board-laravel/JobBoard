@extends('layouts.app')
@extends('layouts.sidebar')
<!-- start sreach part -->
        @section('contentCandidate')
        <div class="container-fluid w-100 d-flex">
        <div class="navbar navbar-light w-25 " style="height:100vh; background:gary !important;">
        <h1 class="bg-light text-center w-100 card-header rounded-5 mt-0">Filter</h1> 
        <div class="container-fluid">
            <form class="d-flex" method="get" action="{{ route('search') }}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <input class="form-control me-2" type="search" name="search" placeholder="Search" value="{{ request('search') }}" aria-label="Search">
                <button class="btn btn-outline-success">Search</button>
            </form>
        </div>
        <div class="w-100 m-2 rounded-5">
            <h1 class="title bg-light text-center w-100 rounded-5">Category</h1>
            <select class="form-control" name="cat">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category_name }}" {{ request('cat') == $category->category_name ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="w-100 rounded-5">
            <h1 class="title bg-light text-center w-100 rounded-5">Salary</h1>
            <input class="form-control me-2" type="number" name="minSalary" placeholder="Min Salary" value="{{ request('minSalary') }}" aria-label="Min Salary">
            <input class="form-control me-2" type="number" name="maxSalary" placeholder="Max Salary" value="{{ request('maxSalary') }}" aria-label="Max Salary">
        </div>
        <div class="w-100 m-2 rounded-5">
            <h1 class="title bg-light text-center w-100 m-2 rounded-5">Date Posted</h1> 
            <input class="form-control me-2" type="date" name="job_created" placeholder="Date Posted" value="{{ request('job_created') }}" aria-label="Date Posted">
        </div>
    </div>

        <div class="w-75">
            
       
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <h1>All Jobs</h1>
                <form class="d-flex" method="get" action="/search">
                    @csrf
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" value="{{@$searchTerm}}" aria-label="Search">
                    <button class="btn btn-outline-success"> Search</button>
                </form>
            </div>
        </nav>

        <!-- start sreach part -->

        @foreach ($jobs as $job)
        <div class="container mt-4">
            <div class="card shadow-sm p-3 mb-4">
                <div class="row align-items-center">
                    <div class="col-1">
                        <img src="{{ asset('images/LogoEmployers/'.$job->logo)}}" alt="Company Logo" class="img-fluid rounded"
                        style="width:auto; height:85px; object-fit:cover;">
                    </div>
                    <div class="col-10">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="#" class="text-decoration-none text-primary fw-bold">{{$job->title}}</a>
                            </div>
                        </div>
                        <div class="text-muted">
                            <span>{{$job->EmployeeCreateJob->name}}</span> <br>
                            <span>{{ $job->location }} ({{$job->work_type}})</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        </div>
        </div>
      
    <!-- <script>
        $(document).ready(function() {
            $('#search').on('input', function() {
                var searchTerm = $(this).val();

                if (searchTerm.length > 2) {
                    $.ajax({
                        url: "{{route('search')}}",
                        method: 'GET',
                        data: {
                            search: searchTerm
                        },
                        success: function(response) {
                            $('#results').empty();
                            if (response.length > 0) {
                                $.each(response, function(index, job) {
                                    $('#results').append(
                                        '<a href="#" class="list-group-item list-group-item-action">' +
                                            job.title + ' - ' + job.location +
                                        '</a>'
                                    );
                                });
                            } else {
                                $('#results').append('<div class="list-group-item">No results found</div>');
                            }
                        }
                    });
                } else {
                    $('#results').empty();
                }
            });
        });
    </script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
 {{--       @if (session('worm'))
 @empty(!$jobs)
<div class="alert alert-dark text-center">
    {{ session('worm') }}
</div>
@endempty
@endif--}}
        @endsection

    