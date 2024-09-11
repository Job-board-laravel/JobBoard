@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <!-- Job Details Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h1 class="mb-4 text-primary">{{ $job->title }}</h1>
                    <p><strong>Description:</strong> {{ $job->description }}</p>
                    <p><strong>Requirements:</strong> {{ $job->requirement }}</p>
                    <p><strong>Benefits:</strong> {{ $job->benefit }}</p>
                    <p><strong>Location:</strong> {{ $job->location }}</p>
                    <p><strong>Contact Info:</strong> {{ $job->contact_info }}</p>
                    {{-- <p><strong>Logo:</strong> <img src="{{ $job->logo }}" alt="Job Logo" class="img-fluid"></p> --}}
                    <p><strong>Technologies:</strong> {{ $job->technologies }}</p>
                    <p><strong>Work Type:</strong> {{ $job->work_type }}</p>
                    <p><strong>Salary Range:</strong> {{ $job->salary_range }}</p>
                    <p><strong>Created:</strong> {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans(['parts' => 3, 'join' => ', ']) }}</p>
                    <p><strong>Application Deadline:</strong> {{ $job->application_deadline }}</p>
                    <p><strong>Number of Applicants:</strong> {{ $applicationCount }}</p> <!-- Added line -->

                    <!-- Apply Button for Candidates -->
                    @if(auth()->user()->role === 'Candidate')
                        <a href="{{ route('applications.create', $job->job_id) }}" class="btn btn-success mt-3">Apply Now</a>
                    @endif

                    <!-- Show Applications Link for Employers if Status is Pending -->
                   
                </div>
            </div>

            <!-- Comments Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white"><h5>Comments</h5></div>
                <div class="card-body">
                    <ul class="list-group mb-3">
                        @foreach($comments as $comment)
                            @php
                                $createdAt = DateTime::createFromFormat('Y-m-d H:i:s', $comment->created_at);
                                $createdAt = \Carbon\Carbon::parse($createdAt)->diffForHumans(['parts' => 3, 'join' => ', ']);
                            @endphp
                            <li class="list-group-item">
                                <strong>{{ $comment->user_name }}</strong> - <em>{{ $createdAt }}</em>
                                <p>{{ $comment->content }}</p>
                                @if(auth()->user()->role === 'Admin')
                                    <form action="{{ route('comments.destroy', $comment->comment_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    
                    <!-- Add Comment Form -->
                    <form action="{{ route('comments.store', $job->job_id) }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="content">Comment</label>
                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>
                </div>
            </div>
        </div>
        @if(auth()->user()->role !== 'Candidate')

        <!-- Candidates Applied Section -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white"><h5>Candidates Applied</h5></div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($applications as $application)
                            <li class="list-group-item">{{ $application->user_name }} - Status: {{ $application->status }} 
                                @if(auth()->user()->role === 'Employer' && $application->status === 'Applied')
                                    <a href="{{ route('applications.show', $application->application_id) }}" class="text-decoration-none text-info">App</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
