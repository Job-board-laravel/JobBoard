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
        if(Auth::user()->role == "Candidate"){
            $jobs = Newjob::where('stutas', 'Approve')->paginate(10);
            $categories = Categorie::all();
            // dd($categories);
            return view('candidate.index', compact('jobs','categories'));
        }else if (Auth::user()->role == "Employer"){
            $jobs = Newjob::withTrashed()->where('user_id',Auth::user()->user_id)->paginate(10);
            return view('employer.index', compact('jobs'));
        }else{
            $acceptedJobs = Newjob::where('stutas', 'Approve')->paginate(10);
            return view('users.index', compact('acceptedJobs'));
        }
        // return view('home');
    }
}
