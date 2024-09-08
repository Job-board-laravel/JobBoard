<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        //
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
    $candidates = User::where('role', 'Candidate')->get();
    return view('users.candidates', compact('candidates'));
}

public function showEmployers()
{
    $employers = User::where('role', 'Employer')->get();
    return view('users.employers', compact('employers'));
}


    public function showUserDetails($id)
{
    // Find the user by their ID
    $user = User::findOrFail($id);

    // Pass the user to the view
    return view('users.details', compact('user'));
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
