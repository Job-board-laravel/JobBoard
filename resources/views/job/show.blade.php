@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $job->title }}</h1>
    <div class="row">
        <div class="col-md-8">
            <p><strong>Description:</strong> {{ $job->description }}</p>
            <p><strong>Requirements:</strong> {{ $job->requirement }}</p>
            <p><strong>Benefits:</strong> {{ $job->benefit }}</p>
            <p><strong>Location:</strong> {{ $job->location }}</p>
            <p><strong>Contact Info:</strong> {{ $job->contact_info }}</p>
       {{--    <p><strong>Logo:</strong> <img src="{{ $job->logo }}" alt="Job Logo"></p>--}}
            <p><strong>Technologies:</strong> {{ $job->technologies }}</p>
            <p><strong>Work Type:</strong> {{ $job->work_type }}</p>
            <p><strong>Salary Range:</strong> {{ $job->salary_range }}</p>
            <p><strong>Create From:</strong> {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans(['parts' => 3 , 'join' => ', '])
 }}</p>

            <p><strong>Application Deadline:</strong> {{ $job->application_deadline }}</p>

            <h2>Comments</h2>
            <ul>
                @foreach($comments as $comment)
                @php
                        $createdAt = DateTime::createFromFormat('Y-m-d H:i:s', $comment->created_at);
                        $createdAt=\Carbon\Carbon::parse($createdAt)->diffForHumans(['parts' => 3 , 'join' => ', '])

                    @endphp
                    <li>{{ $comment->user_name }} form {{ $createdAt}}
                      <p>  {{ $comment->content }} <p>
                     @if( auth()->user()->role === 'Admin')
                        <form action="{{ route('comments.destroy', $comment->comment_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @endif
                    </li>
                        @endforeach
            </ul>

            <h2>Add a Comment</h2>
            <form action="{{ route('comments.store', $job->job_id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="content">Comment</label>
                    <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-4"  >
            <h2>Candidates Applied</h2>
            <ul>
                @foreach($applications as $application)
                    <li>{{ $application->user_name }} - Status: {{ $application->status }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
