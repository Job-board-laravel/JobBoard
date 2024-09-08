<?php

namespace App\Http\Controllers;

use App\Models\Newjob;
use Illuminate\Http\Request;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ApplicationController;

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
    public function show($id)
    {
        //
       
        $job = Newjob::findOrFail($id);

        // Fetch comments with user details
        $comments = $this->commentController->getCommentsByJobId($id);

        // Fetch applications with user details
        $applications = $this->applicationController->getApplicationsByJobId($id);

        return view('job.show', compact('job', 'comments', 'applications'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Newjob $newjob)
    {
        //
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
