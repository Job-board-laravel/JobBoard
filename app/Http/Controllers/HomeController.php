<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Newjob;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ApplicationController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jobs = Newjob::withTrashed()->get();;
        if(Auth::user()->role == "Candidate"){
            return view('candidate.index', compact('jobs'));

        }else if (Auth::user()->role == "Employer"){
            return view('employer.index', compact('jobs'));
        }else{
            $acceptedJobs = Newjob::where('stutas', 'Approve')
            ->join('users', 'newjobs.user_id', '=', 'users.user_id')
            ->join('categories', 'newjobs.category_id', '=', 'categories.category_id')
            ->select('newjobs.*', 'users.name as user_name', 'categories.category_name as category_name')
            ->get();
            return view('users.index', compact('acceptedJobs'));
        }
        // return view('home');
    }
}
