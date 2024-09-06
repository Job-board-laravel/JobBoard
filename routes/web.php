<?php
use App\Http\Controllers\NewjobController;
use Illuminate\Support\Facades\Route;

//Route::get('/', [NewjobController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});

// routers for page employer
Route::resource('employer', NewjobController::class);

Route::get('/employer/{employer}/edit', [NewjobController::class, 'edit'])->name('employer.edit');
Route::put('/employer/{job_id}', [NewjobController::class, 'update'])->name('employer.update');

