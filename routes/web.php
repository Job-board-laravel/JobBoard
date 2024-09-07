<?php
use App\Http\Controllers\NewjobController;
use Illuminate\Support\Facades\Route;

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
