<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function store(Request $request, $jobId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Comment::create([
            'content' => $request->content,
            'job_id' => $jobId,
            'user_id' => auth()->user()->user_id, // Assuming the authenticated user's ID is stored in 'user_id'
        ]);

        return redirect()->route('job.show', $jobId)->with('success', 'Comment added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        // Ensure the user is authorized to delete the comment
        if (auth()->user()->role !== 'Admin') {
            return redirect()->back()->withErrors(['message' => 'You are not authorized to delete this comment.']);
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
    public function getCommentsByJobId($jobId)
    {
        return DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.user_id')
            ->select('comments.*', 'users.name as user_name')
            ->where('comments.job_id', $jobId)
            ->get();
    }

}
