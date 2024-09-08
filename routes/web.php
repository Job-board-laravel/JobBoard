<?php
use App\Models\User;
use App\Models\Newjob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewjobController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ApplicationController;

//Route::get('/', [NewjobController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});

// routers for page employer
Route::resource('employer', NewjobController::class);
Route::resource('candidate', NewjobController::class);



Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::patch('/employer/{job_id}/restore', [NewjobController::class, 'restore'])->name('employer.restore');

Route::get('/users/{id}', [UserController::class, 'showUserDetails'])->name('users.show');
Route::get('/candidates', [UserController::class, 'showCandidates'])->name('users.candidates');
Route::get('/employers', [UserController::class, 'showEmployers'])->name('users.employers');


Route::get('application',[ApplicationController::class,'index']);
Route::get('/search',[NewjobController::class,'search'])->name('search');



// mohsen
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
