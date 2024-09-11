<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Newjob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreApllicationRequest;
use App\Http\Requests\UpdateApllicationRequest;



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
        $applications = Application::withTrashed()->where('user_id',$userId)->paginate(10);
        // dd($applications);
        return view('application.index', compact('applications'));
    }

    /**
     * Get applications for a specific user that are not deleted.
     *
     * @param int $userId
     * @return array
     */



    /**
     * Show the form for creating a new resource.
     */
    public function createApp($job_id)
    {
        $this->authorize('create', Application::class);
        $job = Newjob::findOrFail($job_id);
        return view('application.createApp', compact('job'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApllicationRequest $request)
    {
        // dd($request);
        $this->authorize('create', Application::class);
        $user_id = Auth::user()->user_id;
        $data = $request->all();
        $data['user_id'] = $user_id;
        // dd($data);
        Application::create($data);
        return redirect()->route('application.index')->with('success', 'Application submitted successfully!');
    }
    public function show(Application $application)
    {
        // $application = Application::where('application_id', $id)->firstOrFail();
        // if(!Gate::allows('view', $application)){
        //     abort(403);
        // }
        return view('application.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $application = Application::where('application_id', $id)->firstOrFail();
        if(!Gate::allows('update', $application)){
            abort(403);
        }
        $application = Application::findOrFail($id);
        return view('application.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateApllicationRequest $request, $id)
    {
        // Validate the request
        $application = Application::where('application_id', $id)->firstOrFail();
        if(!Gate::allows('update', $application)){
            abort(403);
        }
        $data = $request->all();
        // dd($data);
        $application = Application::findOrFail($id);
        // if(!$applaction){

        // }
        $application->update($data);
        return redirect()->route('application.show', $application)->with('success', 'Application updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the application by ID
            $application = Application::findOrFail($id);
            // dd(11);
            $application->delete();
            return redirect()->route('application.index')->with('success', 'Application deleted successfully.');
        } catch (Exception $e) {
            // Redirect back with an error message if something goes wrong
            return redirect()->route('application.index')->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function restore($id)
    {
        $application = Application::withTrashed()->where('application_id', $id)->first();
        if(!Gate::allows('restore', $application)){
            abort(403);
        }
        $application->restore();
        return redirect()->route('application.index')->with('success', 'Job restored successfully.');
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

