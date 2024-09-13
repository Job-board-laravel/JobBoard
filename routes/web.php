<?php
use App\Models\User;
use App\Models\Newjob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewjobController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ApplicationController;

//Route::get('/', [NewjobController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});

// routers for page employer
Route::resource('employer', NewjobController::class);
Route::get('candidate/index', [NewjobController::class, 'search'])->name('candidate.index');
Route::resource('candidate', NewjobController::class);

// Define named routes for rejected and pending jobs
Route::get('/users/rejectedJobs', [NewjobController::class, 'rejectedJobs'])->name('users.rejectedJobs');
Route::get('/users/pendingJobs', [NewjobController::class, 'pendingJobs'])->name('users.pendingJobs');

Route::resource('users', UserController::class);



Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::patch('/employer/{job_id}/restore', [NewjobController::class, 'restore'])->name('employer.restore');

Route::get('/users/{id}', [UserController::class, 'showUserDetails'])->name('users.show');
Route::get('/candidates', [UserController::class, 'showCandidates'])->name('users.candidates');
Route::get('/employers', [UserController::class, 'showEmployers'])->name('users.employers');


// Route::get('application',[ApplicationController::class,'index']);
Route::get('/search',[NewjobController::class,'search'])->name('search');


Route::put('/jobs/{job}/update-status', function (Request $request, Newjob $job) {
    $job->update(['stutas' => $request->input('status')]);
    return redirect()->route('users.pendingJobs')->with('success', 'Job status updated successfully.');
})->name('update.job.status');

Route::get('/job/{id}', [NewjobController::class, 'show'])->name('job.show');
Route::post('/comments/{job_id}', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


Route::get('/application/{job_id}/createApp', [ApplicationController::class, 'createApp'])->name('application.createApp');


// Route::post('/application/store', [ApplicationController::class, 'store'])->name('application.store');
Route::resource('application', ApplicationController::class);


Route::patch('/application/{application_id}/restore', [ApplicationController::class, 'restore'])->name('application.restore');


Route::post('/applications/{id}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
Route::post('/applications/{id}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
