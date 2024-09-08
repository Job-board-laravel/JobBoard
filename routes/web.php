<?php
use App\Http\Controllers\NewjobController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//Route::get('/', [NewjobController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});

// routers for page employer
Route::resource('employer', NewjobController::class);
Route::resource('candidate', NewjobController::class);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
