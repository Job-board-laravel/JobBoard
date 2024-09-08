<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Newjob;
use Illuminate\Http\Request;
use App\Models\Categorie;

class NewjobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        $this->middleware("auth");
    }
    public function index()
    {

        $jobs = Newjob::all();
        if(Auth::user()->role == "Candidate"){
            return view('candidate.index', compact('jobs'));

        }else if (Auth::user()->role == "Employer"){
            return view('employer.index', compact('jobs'));
        }else{

        }
    }


    public function create()
    {
        $categories = Categorie::all();
        return view('employer.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'requirement' => 'required',
        'benefit' => 'required',
        'location' => 'required|string|max:255',
        'technologies' => 'required',
        'work_type' => 'required|in:remote,onsite,hybrid',
        'salary_range' => 'nullable|numeric',
        'application_deadline' => 'required|date',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'category_id' => 'required|exists:categories,category_id',
    ]);

        // Handle the image upload
        if ($request->hasFile('logo')) {
            $image = request()->file("logo");
            $imageName = $image->store("",'logo_Employer');
        } else {
            $imageName = null;
        }
        $userId = Auth::user()->user_id;
        $categoryId = $request->category_id;

        $ss = Newjob::create(array_merge(
            $request->all(),
            ['logo' => $imageName , 'user_id' => $userId , 'category_id' => $categoryId]
        ));
        // dd($ss);
        // dd($request);
        // Redirect back to home
        return redirect()->route('employer.index')->with('success', 'Job created successfully');


    $userId = 1;

    Newjob::create(array_merge(
        $request->all(),
        ['logo' => $imageName, 'user_id' => $userId]
    ));

    return redirect()->route('employer.index')->with('success', 'Job created successfully');
}

    /**
     * Display the specified resource.
     */
    public function show($job_id)
    {
    // Find the job by its job_id, including the related category
         if(Auth::user()->role == "Candidate"){
            $job = Newjob::with('jobCategory')->where('job_id', $job_id)->firstOrFail();
            return view('candidate.show', compact('job'));
         }else{
            $job = Newjob::with('jobCategory')->where('job_id', $job_id)->firstOrFail();
            return view('employer.show', compact('job'));
         }


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($job_id)
    {
        $job = Newjob::where('job_id', $job_id)->firstOrFail();
        return view('employer.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $job_id)
    {
        // Validate the request data if needed
        $data = request()->All();
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'requirement' => 'required',
            'benefit' => 'required',
            'location' => 'required|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'logo' => 'nullable|image',
            'technologies' => 'required|string',
            'work_type' => 'required|in:remote,onsite,hybrid',
            'salary_range' => 'nullable|numeric',
            'application_deadline' => 'required|date',
            // Add more validation rules as needed
        ]);

        // Find the job by job_id
        $job = Newjob::where('job_id', $job_id)->first(); // Retrieve or fail if not found

        // Set user_id to a specific value (assuming this is necessary)
        $logoPath = $job->logo;
        // Handle file upload if a new logo is provided
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
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newjob $newjob)
    {
        //
    }
}
