<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .imgEmp {
            width: auto;
            height: 90px;
            object-fit: cover;
        }

        tr {
            text-align: center;
        }
        body, html {
            height: 100%; /* Ensure the body and html take the full height */
        }

        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        /* Optional margin for space above the footer */
        .content-wrapper {
            min-height: calc(100vh - 100px); /* Adjust '100px' based on your footer height */
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body  style="background-color:rgb(216,230,230,0,8);" class="min-vh-100 d-flex flex-column">
    <div id="app" >
        <nav class="navbar navbar-expand-md navbar shadow-sm border-bottom border-light  rounded-5" style="font-size: 2em">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if(Auth::user()->role == 'Candidate')
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('candidate.index') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('application.index') }}">My Application</a>
                                </li>
                            @elseif(Auth::user()->role == 'Employer')
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('employer.index') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('employer.create') }}">Create Job</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.index') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.employers') }}">Employees</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.candidates') }}">Candidates</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.pendingJobs') }}">Pending Jobs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.rejectedJobs') }}">Rejected Jobs</a>
                                </li>
                            @endif
                        @endauth

                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ asset('images/Users/' . Auth::user()->image) }}" class="rounded-circle" width="50" height="50">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>

        </nav>
        </li>


    </div>
    <div class="container mt-5" >
        @yield('content')
    </div>
    <div class="h-100" style="">
        @yield('contentCandidate')
    </div>
    </div>
    @extends('layouts.footer')
</body>
</html>
