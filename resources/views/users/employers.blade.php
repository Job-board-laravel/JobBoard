@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Employers List</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employers as $employer)
                    <tr>
                        <td>{{ $employer->name }}</td>
                        <td>{{ $employer->email }}</td>
                        <td>{{ $employer->phone }}</td>
                        <td>
                            <a href="{{ route('users.show', $employer->user_id) }}" class="btn btn-info">Show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{$employers->links()}}
@endsection
