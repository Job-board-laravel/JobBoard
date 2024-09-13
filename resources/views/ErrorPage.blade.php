@extends('layouts.app')

@section('content')
<h1>You are {{Auth::user()->role}} user can not access this action</h1>
<h2><a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Go Back</a></h2>
@endsection
