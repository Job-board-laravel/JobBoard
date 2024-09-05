<?php
use App\Http\Controllers\NewjobController;
use Illuminate\Support\Facades\Route;

//Route::get('/', [NewjobController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::resource('employer', NewjobController::class);