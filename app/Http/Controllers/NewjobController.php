<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Newjob;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UpdateJopRequest;
use App\Http\Requests\StoreJopRequest;

class NewjobController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $commentController;
    protected $applicationController;

    public function __construct(CommentController $commentController, ApplicationController $applicationController)
    {
        $this->commentController = $commentController;
        $this->applicationController = $applicationController;
        $this->middleware("auth");

    }
    public function index()
    {
        $role = Auth::user()->role;
        if(!$this->authorize('viewAny', [Newjob::class, $role])){
            // abort(402);
            return view('ErrorPage');

        }
        // dd(11233);
        if($role == "Candidate"){
            $jobs = Newjob::where('stutas', 'Approve')->paginate(10);
            // dd($jobs);
            $categories = Categorie::all();
            // dd($categories);
            return view('candidate.index', compact('jobs','categories'));

        }else if ($role == "Employer"){
            $jobs = Newjob::withTrashed()->where('user_id',Auth::user()->user_id)->paginate(10);
            return view('employer.index', compact('jobs'));
        }else{
            $acceptedJobs = Newjob::where('stutas', 'Approve')->paginate(10);
            return view('users.index', compact('acceptedJobs'));
        }
    }

    public function search(Request $request)
    {

        $request->validate([
            'search' => 'nullable|string|max:255',
            'minSalary' => 'nullable|numeric',
            'maxSalary' => 'nullable|numeric',
            'job_created' => 'nullable|date',
            'cat' => 'nullable|exists:categories,category_name',
        ]);
        $query = Newjob::query();
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%$searchTerm%")
                    ->orWhere('location', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%")
                    ->orWhere('work_type', 'like', "%$searchTerm%")
                    ->orWhereHas('JobCategory', function ($q) use ($searchTerm) {
                        $q->where('category_name', 'like', "%$searchTerm%");
                    });
            });
        }
        if ($request->has('category_name')) {
            $category = $request->input('cat');
            $query->whereHas('JobCategory', function ($q) use ($category) {
                $q->where('category_name', $category);
            });
        }
        if ($request->has('minSalary') && $request->has('maxSalary')) {
            $minSalary = $request->input('minSalary');
            $maxSalary = $request->input('maxSalary');
            $query->whereBetween('salary_range', [$minSalary, $maxSalary]);
        }
        if ($request->has('job_created')) {
            $jobCreated = $request->input('job_created');
            $query->whereDate('date_posted', $jobCreated);
        }

        // if(!$query->get()){
            //     return 'no reslat';
            // }
        $jobs = $query->paginate(3);
        $categories = Categorie::all();
        // return $jobs;
        return view('candidate.index', compact('jobs', 'categories'));
    }





    public function create()
    {
        $this->authorize('create', Newjob::class);
        $categories = Categorie::all();
        return view('employer.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJopRequest $request)
    {

        $this->authorize('create', Newjob::class);

        if ($request->hasFile('logo')) {
            $image = request()->file("logo");
            $imageName = $image->store("", 'logo_Employer');
        } else {
            $imageName = null;
        }
        $userId = Auth::user()->user_id;
        $categoryId = $request->category_id;

        $ss = Newjob::create(array_merge(
            $request->all(),
            ['logo' => $imageName, 'user_id' => $userId, 'category_id' => $categoryId]
        ));

        return redirect()->route('employer.index')->with('success', 'Job created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($job_id)
    {

        // if(Auth::user()->role == "Candidate"){
        //     $job = Newjob::withTrashed()->with('jobCategory')->where('job_id', $job_id)->firstOrFail();
        //     return view('candidate.show', compact('job'));
        //  }
        //  elseif(Auth::user()->role == "Employer"){
        //     $job = Newjob::withTrashed()->with('jobCategory')->where('job_id', $job_id)->firstOrFail();
        //     return view('job.show', compact('job', ''));
        //  }
        //  else{
            $job = Newjob::withTrashed()->findOrFail($job_id);
            $comments = $this->commentController->getCommentsByJobId($job_id);
            $applications = $this->applicationController->getApplicationsByJobId($job_id);
            $applicationCount = $applications->count(); // Count the number of applicants

            return view('job.show', compact('job', 'comments', 'applications','applicationCount'));
        // }

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($job_id)
    {
        $job = Newjob::withTrashed()->where('job_id', $job_id)->firstOrFail();
        if(!Gate::allows('update', $job)){
            return view('ErrorPage');
        }
        $categories = Categorie::all();

        return view('employer.edit', compact('job','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJopRequest $request, $job_id)
    {


        $job = Newjob::where('job_id', $job_id)->first();
        if(!Gate::allows('update', $job)){
            return view('ErrorPage');
        }

        $logoPath = $job->logo;
        $data = $request->all();
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $logoPath = $image->store('', 'logo_Employer');
            $data['logo'] = $logoPath;
        }
        // dd($job);
        $job->update($data);
        // dd($job);
        return redirect()->route('employer.show', $job_id)->with('success', 'Job updated successfully');
    }

    public function rejectedJobs()
    {
        $rejectedJobs = Newjob::where('stutas', 'Reject')
            ->join('users', 'newjobs.user_id', '=', 'users.user_id')
            ->join('categories', 'newjobs.category_id', '=', 'categories.category_id')
            ->select('newjobs.*', 'users.name as user_name', 'categories.category_name as category_name')
            ->paginate(10);

        return view('users.rejected', compact('rejectedJobs'));
    }

    public function pendingJobs()
    {
        // dd(111);
        if(Auth::user()->role === "Admin"){
            $pendingJobs = Newjob::where('stutas', 'Pending')
            ->join('users', 'newjobs.user_id', '=', 'users.user_id')
            ->join('categories', 'newjobs.category_id', '=', 'categories.category_id')
            ->select('newjobs.*', 'users.name as user_name', 'categories.category_name as category_name')
            ->paginate(10);
             return view('users.pendingJobs', compact('pendingJobs'));
        }
        else{
                return view('ErrorPage');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($job_id)
    {

        $job = Newjob::where('job_id', $job_id)->first();
        if(!Gate::allows('delete', $job)){
            return view('ErrorPage');
        }
        $job = Newjob::findOrFail($job_id);
        $job->delete();
        return redirect()->route('employer.index')->with('success', 'Job deleted successfully.');
    }

    public function restore($job_id)
    {
        $job = Newjob::withTrashed()->where('job_id', $job_id)->first();
        if(!Gate::allows('restore', $job)){
            return view('ErrorPage');
        }
        $job->restore();
        return redirect()->route('employer.index')->with('success', 'Job restored successfully.');
    }

}
