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
        if(!$this->authorize('viewAny', [Application::class])){
            return view('ErrorPage');

        }
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
        if(!$this->authorize('create', Application::class)){
            return view('ErrorPage');

        }
        $job = Newjob::findOrFail($job_id);
        return view('application.createApp', compact('job'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApllicationRequest $request)
    {
        // dd($request);
        if(!$this->authorize('create', Application::class)){
            return view('ErrorPage');

        }
        $user_id = Auth::user()->user_id;
        $data = $request->all();
        $data['user_id'] = $user_id;
        // dd($data);
        if(Auth::user()->UserApp()->where('job_id', $data['job_id'])->count()>0){
            return redirect()->route('application.index')->with('applied', 'You have already applied for this job.');
        }
        Application::create($data);
        return redirect()->route('application.index')->with('success', 'Application submitted successfully!');
    }
    public function show(Application $application)
    {
        return view('application.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $application = Application::where('application_id', $id)->firstOrFail();
        if(!Gate::allows('update', $application)){
            return view('ErrorPage');
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
            return view('ErrorPage');
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
            return view('ErrorPage');
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
    public function accept($id)
{
    $application = Application::findOrFail($id);
    // Update the application status to accepted
    $application->status = 'Accepted';
    $application->save();

    return redirect()->route('job.show', $application->job_id)->with('success', 'Application accepted successfully.');
}
public function reject($id)
{
    $application = Application::findOrFail($id);
    // Update the application status to rejected
    $application->status = 'rejected';
    $application->save();

    return redirect()->route('job.show',$application->job_id)->with('success', 'Application accepted successfully.');
}
}

