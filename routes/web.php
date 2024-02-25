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

Route::get('years/index', [YearController::class, 'index'])->name('years.index');
Route::get('years/index/trashed', function () {
    return redirect()->route('years.index', ['trashed' => 'true']);
})->name('years.trashed');
Route::get('years/form/{year?}', [YearController::class, 'form'])->name('years.form');
Route::post('years/{year}/restore', [YearController::class, 'restore'])->name('years.restore');
Route::resource('years', YearController::class);

Route::get('semesters/index', [SemesterController::class, 'index'])->name('semesters.index');
Route::get('semesters/index/trashed', function () {
    return redirect()->route('semesters.index', ['trashed' => 'true']);
})->name('semesters.trashed');
Route::get('semesters/form/{semester?}', [SemesterController::class, 'form'])->name('semesters.form');
Route::post('semesters/{semester}/restore', [SemesterController::class, 'restore'])->name('semesters.restore');
Route::resource('semesters', SemesterController::class);

Route::get('subjects/index', [SubjectController::class, 'index'])->name('subjects.index');
Route::get('subjects/index/trashed', function () {
    return redirect()->route('subjects.index', ['trashed' => 'true']);
})->name('subjects.trashed');
Route::get('subjects/form/{subject?}', [SubjectController::class, 'form'])->name('subjects.form');
Route::post('subjects/{subject}/restore', [SubjectController::class, 'destroy'])->name('subjects.restore');
Route::resource('subjects', SubjectController::class);

Route::get('questions/index', [QuestionController::class, 'index'])->name('questions.index');
Route::get('questions/index/trashed', function () {
    return redirect()->route('questions.index', ['trashed' => 'true']);
})->name('questions.trashed');
Route::get('questions/form/{question?}', [QuestionController::class, 'form'])->name('questions.form');
Route::post('questions/{question}/restore', [QuestionController::class, 'destroy'])->name('questions.restore');
Route::resource('questions', QuestionController::class);

Route::get('exams/index', [ExamController::class, 'index'])->name('exams.index');
Route::get('exams/index/trashed', function () {
    return redirect()->route('exams.index', ['trashed' => 'true']);
})->name('exams.trashed');
Route::get('exams/form/{exam?}', [ExamController::class, 'form'])->name('exams.form');
Route::post('exams/{exam}/restore', [ExamController::class, 'destroy'])->name('exams.restore');
Route::resource('exams', ExamController::class);

Route::get('statistics', [StatisticController::class,'index'])->name('statistics.index');






