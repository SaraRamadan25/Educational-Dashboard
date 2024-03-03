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

Route::get('get-semesters/{year}', [SemesterController::class, 'getSemestersByYear']);

Route::get('years/create', [YearController::class, 'form'])->name('years.create');
Route::get('years/{year}/edit', [YearController::class, 'form'])->name('years.edit');
Route::get('years/trashed', [YearController::class, 'index'])->name('years.trashed');
Route::post('years/{year}/restore', [YearController::class, 'restore'])->name('years.restore');
Route::resource('years', YearController::class)->except(['create', 'edit']);

Route::get('semesters/create', [SemesterController::class, 'form'])->name('semesters.create');
Route::get('semesters/{semester}/edit', [SemesterController::class, 'form'])->name('semesters.edit');
Route::get('semesters/trashed', [SemesterController::class, 'index'])->name('semesters.trashed');
Route::post('semesters/{semester}/restore', [SemesterController::class, 'restore'])->name('semesters.restore');
Route::resource('semesters', SemesterController::class)->except(['create', 'edit']);

Route::get('subjects/create', [SubjectController::class, 'form'])->name('subjects.create');
Route::get('subjects/{subject}/edit', [SubjectController::class, 'form'])->name('subjects.edit');
Route::get('subjects/trashed', [SubjectController::class, 'index'])->name('subjects.trashed');
Route::post('subjects/{subject}/restore', [SubjectController::class, 'destroy'])->name('subjects.restore');
Route::resource('subjects', SubjectController::class)->except(['create', 'edit']);

Route::get('questions/create', [QuestionController::class, 'form'])->name('questions.create');
Route::get('questions/{question}/edit', [QuestionController::class, 'form'])->name('questions.edit');
Route::get('questions/trashed', [QuestionController::class, 'index'])->name('questions.trashed');
Route::post('questions/{question}/restore', [QuestionController::class, 'destroy'])->name('questions.restore');
Route::resource('questions', QuestionController::class)->except(['create', 'edit']);

Route::get('exams/create', [ExamController::class, 'form'])->name('exams.create');
Route::get('exams/{exam}/edit', [ExamController::class, 'form'])->name('exams.edit');
Route::get('exams/trashed', [ExamController::class, 'index'])->name('exams.trashed');
Route::post('exams/{exam}/restore', [ExamController::class, 'destroy'])->name('exams.restore');
Route::resource('exams', ExamController::class)->except(['create', 'edit']);

Route::get('statistics', [StatisticController::class,'index'])->name('statistics.index');






