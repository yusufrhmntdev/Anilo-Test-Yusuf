<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
Route::resource('student', App\Http\Controllers\StudentController::class);
Route::resource('subject', App\Http\Controllers\SubjectController::class);
Route::resource('score', App\Http\Controllers\ScoreController::class);