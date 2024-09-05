<?php
use App\Http\Controllers\NewjobController;
use Illuminate\Support\Facades\Route;

//Route::get('/', [NewjobController::class, 'index'])->name('home');



Route::resource('employer', NewjobController::class);