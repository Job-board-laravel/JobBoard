<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function __construct()
    {
         $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::id();

        // Fetch applications using raw SQL query
        $applications = $this->getApplicationsForUser($userId);

        return view('candidate.all_applactions', compact('applications'));
    }

    /**
     * Get applications for a specific user that are not deleted.
     *
     * @param int $userId
     * @return array
     */
    protected function getApplicationsForUser($userId)
    {
        return DB::select(
            'SELECT a.*, j.title AS job_title
             FROM applications a
             LEFT JOIN newjobs j ON a.job_id = j.job_id
             WHERE a.user_id = ? AND a.is_deleted = 0',
            [$userId]
        );
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

}
