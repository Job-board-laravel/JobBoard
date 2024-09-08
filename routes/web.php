<?php
use Illuminate\Support\Facades\Route;
use App\Models\Newjob;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\NewjobController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
// Define auth routes
//Auth::routes();

// Apply auth middleware for all routes requiring authentication
//Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $acceptedJobs = Newjob::where('stutas', 'Approve')
            ->join('users', 'newjobs.user_id', '=', 'users.user_id')
            ->join('categories', 'newjobs.category_id', '=', 'categories.category_id')
            ->select('newjobs.*', 'users.name as user_name', 'categories.category_name as category_name')
            ->get();
        return view('home', compact('acceptedJobs'));
    })->name('home');

    Route::get('/employees', function () {
        $employees = User::where('role', 'Employer')->get();
        return view('employees', compact('employees'));
    })->name('employees');

    Route::get('/candidates', function () {
        $candidates = User::where('role', 'Candidate')->get();
        return view('candidates', compact('candidates'));
    })->name('candidates');

    Route::get('/pending-jobs', function () {
        $pendingJobs = Newjob::where('stutas', 'Pending')
            ->join('users', 'newjobs.user_id', '=', 'users.user_id')
            ->join('categories', 'newjobs.category_id', '=', 'categories.category_id')
            ->select('newjobs.*', 'users.name as user_name', 'categories.category_name as category_name')
            ->get();
        return view('pending-jobs', compact('pendingJobs'));
    })->name('pending.jobs');

    Route::put('/jobs/{job}/update-status', function (Request $request, Newjob $job) {
        $job->update(['stutas' => $request->input('status')]);
        return redirect()->route('pending.jobs')->with('success', 'Job status updated successfully.');
    })->name('update.job.status');

    Route::get('/job/{id}', [NewjobController::class, 'show'])->name('job.show');
    Route::post('/comments/{job_id}', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/rejected-jobs',function () {
        $rejectedJobs = Newjob::where('stutas', 'Reject')
            ->join('users', 'newjobs.user_id', '=', 'users.user_id')
            ->join('categories', 'newjobs.category_id', '=', 'categories.category_id')
            ->select('newjobs.*', 'users.name as user_name', 'categories.category_name as category_name')
            ->get();
        return view('rejected', compact('rejectedJobs'))  ;})->name('rejected.jobs'); 
//});
