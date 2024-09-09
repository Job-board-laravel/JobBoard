<?php

use App\Http\Controllers\NewjobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;


//Route::get('/', [NewjobController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});

// routers for page employer
Route::resource('employer', NewjobController::class);
Route::resource('candidate', NewjobController::class);
Route::get('candidate/index', [NewjobController::class, 'search']);


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::patch('/employer/{job_id}/restore', [NewjobController::class, 'restore'])->name('employer.restore');

Route::get('/users/{id}', [UserController::class, 'showUserDetails'])->name('users.show');
Route::get('/candidates', [UserController::class, 'showCandidates'])->name('users.candidates');
Route::get('/employers', [UserController::class, 'showEmployers'])->name('users.employers');
// Route::post('application', [ApplicationController::class, 'create'])->name('application.create');
// Route to show the application form
Route::get('/application/{job_id}/create', [ApplicationController::class, 'create'])->name('application.create');
Route::get('/application/store', [ApplicationController::class, 'store'])->name('application.store');
// Route to handle the form submission
Route::post('/application/store', [ApplicationController::class, 'store'])->name('application.store');
Route::resource('application', ApplicationController::class);
