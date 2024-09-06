<?php

namespace App\Http\Controllers;

use App\Models\Newjob;
use Illuminate\Http\Request;

class NewjobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $jobs = Newjob::all();
    return view('employer.index', compact('jobs'));
}


    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     // Show the form for creating a new job
    //     //$job = Newjob::all();

    //     return view('employer.create');
    // }
    public function create()
    {
    // Fetch all categories from the database
    $categories = \App\Models\Categorie::all();

    // Pass categories to the view
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
        $userId = 1;
        $categoryId = 1 ;

        // Save the job with the image name
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
    $job = Newjob::with('jobCategory')->where('job_id', $job_id)->firstOrFail();

    // Pass the job details to the view
    return view('employer.show', compact('job'));
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
    $job = Newjob::where('job_id', $job_id)->firstOrFail();

    // Set user_id to a specific value
    $job->user_id = 1;

    // Handle file upload if a new logo is provided
    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('images', 'public');
        $job->logo = $logoPath;
    }

    // Update job details including user_id
    $job->title = $request->input('title');
    $job->description = $request->input('description');
    $job->requirement = $request->input('requirement');
    $job->benefit = $request->input('benefit');
    $job->location = $request->input('location');
    $job->contact_info = $request->input('contact_info');
    $job->technologies = $request->input('technologies');
    $job->work_type = $request->input('work_type');
    $job->salary_range = $request->input('salary_range');
    $job->application_deadline = $request->input('application_deadline');

    // Save the updated job
    $job->save();

    // Redirect or return response
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
