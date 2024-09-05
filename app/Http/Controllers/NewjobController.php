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
    public function create()
    {
        // Show the form for creating a new job
        //$job = Newjob::all();
        return view('employer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and store the new job
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
        ]);

        // Handle the image upload
        if ($request->hasFile('logo')) {
            $imageName = time() . '.' . $request->logo->extension();
            $request->logo->storeAs('public/images', $imageName);
        } else {
            $imageName = null;
        }
        $userId = 1;
        $categoryId = 1 ;

        // Save the job with the image name
        Newjob::create(array_merge(
            $request->all(),
            ['logo' => $imageName , 'user_id' => $userId , 'category_id' => $categoryId]
        ));

        // Redirect back to home
        return redirect()->route('employer.index')->with('success', 'Job created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Newjob $newjob)
    {
        return view('employer.show', compact('newjob'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Newjob $newjob)
    {
        return view('employer.edit', compact('newjob'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Newjob $newjob)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newjob $newjob)
    {
        //
    }
}
