<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Newjob;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        $this->middleware("auth");
    }
    public function index()
    {
        //'
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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(User $user)
    // {
    //     //
    // }
    public function showCandidates()
    {
        $candidates = User::where('role', 'Candidate')->paginate(10);
        return view('users.candidates', compact('candidates'));
    }

    public function showEmployers()
    {
        $employers = User::where('role', 'Employer')->paginate(10);
        return view('users.employers', compact('employers'));
    }


    public function showUserDetails($id)
    {
        $user = User::findOrFail($id);
        return view('users.details', compact('user'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
