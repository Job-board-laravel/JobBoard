<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Newjob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applaction = Application::All();
        return view('application.index', compact('applaction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createApp($job_id)
    {
        // Retrieve the job using the job_id
        $job = Newjob::findOrFail($job_id);

        // For debugging purposes (optional)

        // Pass the job data to the view
        return view('application.createApp', compact('job'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Validate the request data
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'cover_letter' => 'required|string',
            'job_id' => 'required|exists:newjobs,job_id',
        ]);

        $user_id = Auth::user()->user_id;
        $data = $request->all();
        $data['user_id'] = $user_id;
        Application::create($data);
        // Redirect with success message
        return redirect()->route('application.index')->with('success', 'Application submitted successfully!');
    }

    // public function submitApplication(Request $request)
    // {
    //     // Validate the request
    //     $validated = $request->validate([
    //         'full_name' => 'required|string|max:255',
    //         'email' => 'required|email',
    //         'phone' => 'required|string|max:15',
    //         // 'resume' => 'required|file|mimes:pdf|max:2048',
    //         'cover_letter' => 'required|string',
    //         'job_id' => 'required|exists:newjobs,job_id',
    //     ]);

    //     // Handle file upload
    //     // if ($request->hasFile('resume')) {
    //     //     $resumePath = $request->file('resume')->store('resumes');
    //     //     $validated['resume'] = $resumePath;
    //     // }

    //     // Save the application data
    //     $request::save();
    //     // Application::create($validated);

    //     return redirect()->back()->with('success', 'Application submitted successfully!');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
    public function getApplicationsByJobId($jobId)
    {
        return DB::table('applications')
            ->join('users', 'applications.user_id', '=', 'users.user_id')
            ->select('applications.*', 'users.name as user_name')
            ->where('applications.job_id', $jobId)
            ->get();
    }
}
