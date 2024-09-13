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


    public function showCandidates()
    {
        if(Auth::user()->role === "Admin"){
            $candidates = User::where('role', 'Candidate')->paginate(10);
            return view('users.candidates', compact('candidates'));
        }
        else{
            return view('ErrorPage');
        }
    }

    public function showEmployers()
    {
        if(Auth::user()->role === "Admin"){
            $employers = User::where('role', 'Employer')->paginate(10);
            return view('users.employers', compact('employers'));
        }
        else{
            return view('ErrorPage');
        }
    }


    public function showUserDetails($id)
    {
        if(Auth::user()->role === "Admin"){
            $user = User::findOrFail($id);
            return view('users.details', compact('user'));
        }
        else{
            return view('ErrorPage');
        }
    }

    public function show($id)
    {
        if(Auth::user()->role === "Admin"){
            $user = User::findOrFail($id);
            return view('users.show', compact('user'));
        }
        else{
            return view('ErrorPage');
        }
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
