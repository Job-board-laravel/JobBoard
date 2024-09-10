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


     public function __construct()
    {
        // $applaction = Application::All();
        // return view('application.index', compact('applaction'));
         $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::id();

        // Fetch applications using raw SQL query
        $applications = $this->getApplicationsForUser($userId);

        return view('candidate.all_applactions', compact('applications'));

    // $applications = Application::all();  // Fetch applications or any data you need
    // return view('application.index')->with('applications', $applications);


    }

    /**
     * Get applications for a specific user that are not deleted.
     *
     * @param int $userId
     * @return array
     */
    protected function getApplicationsForUser($userId)
    {
        return DB::table('applications as a')
            ->leftJoin('newjobs as j', 'a.job_id', '=', 'j.job_id')
            ->select('a.*', 'j.title as job_title')
            ->where('a.user_id', $userId)
            ->where('a.is_deleted', 0)
            ->get();
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
    public function edit($id)
{
    $application = Application::findOrFail($id);
    return view('application.edit', compact('application'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);
    
        // Find the application by ID
        $application = Application::findOrFail($id);
    
        // Update the application status
        $application->status = $request->input('status');
        $application->save();
    
        // Redirect back with success message
        return redirect()->route('application.index')->with('success', 'Application updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the application by ID
            $application = Application::findOrFail($id);

            // Mark the application as deleted
            $application->is_deleted = true;
            $application->save();

            // Redirect back to the applications list with a success message
            return redirect()->route('applications.index')->with('success', 'Application deleted successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message if something goes wrong
            return redirect()->route('applications.index')->withErrors(['error' => $e->getMessage()]);
        }
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
