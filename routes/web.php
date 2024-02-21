<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\YearController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('master');
})->name('home');

Route::get('years/trashed', [YearController::class, 'trashed'])->name('years.trashed');
Route::post('years/{year}/restore', [YearController::class, 'restore'])->name('years.restore');
Route::resource('years', YearController::class);

Route::get('semesters/trashed', [SemesterController::class, 'trashed'])->name('semesters.trashed');
Route::post('semesters/{semester}/restore', [SemesterController::class, 'restore'])->name('semesters.restore');
Route::resource('semesters', SemesterController::class);

Route::get('subjects/trashed', [SubjectController::class, 'trashed'])->name('subjects.trashed');
Route::post('subjects/{subject}/restore', [SubjectController::class, 'restore'])->name('subjects.restore');
Route::resource('subjects', SubjectController::class);

Route::get('questions/trashed', [QuestionController::class, 'trashed'])->name('questions.trashed');
Route::post('questions/{question}/restore', [QuestionController::class, 'restore'])->name('questions.restore');
Route::resource('questions', QuestionController::class);

Route::get('exams/trashed', [ExamController::class, 'trashed'])->name('exams.trashed');
Route::post('exams/{exam}/restore', [ExamController::class, 'restore'])->name('exams.restore');
Route::resource('exams', ExamController::class);

Route::get('statistics', [StatisticController::class,'index'])->name('statistics.index');






