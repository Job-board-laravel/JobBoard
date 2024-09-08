<!-- resources/views/employees.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employees</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection