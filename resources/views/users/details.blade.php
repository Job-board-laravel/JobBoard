@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Details</h1>
        <div class="card">
            <div class="card-header">
                Details of {{ $user->name }}
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Phone:</strong> {{ $user->phone }}</p>
                <p><strong>Role:</strong> {{ $user->role }}</p>
                @if ($user->role == 'Employer')
                    <p><strong>Company:</strong> {{ $user->company_name ?? 'N/A' }}</p>
                @endif
                <p><strong>Joined On:</strong> {{ $user->created_at->format('d M Y') }}</p>
            </div>
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
    </div>
@endsection
