<!-- resources/views/candidates.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Candidates</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidates as $candidate)
            <tr>
                <td>{{ $candidate->name }}</td>
                <td>{{ $candidate->email }}</td>
                <td>{{ $candidate->phone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection