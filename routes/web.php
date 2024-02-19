<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StatisicController;
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

Route::get('subjects/trashed', [SubjectController::class, 'trashed'])->name('semesters.trashed');
Route::post('subjects/{subject}/restore', [SubjectController::class, 'restore'])->name('semesters.restore');
Route::resource('subjects', SubjectController::class);

Route::get('exams', [ExamController::class,'index'])->name('exams.index');
Route::get('questions', [QuestionController::class,'index'])->name('questions.index');

/*Route::get('questions/{exam:exam_name}', [QuestionController::class,'index'])->name('questions.index');*/
/*Route::get('questions/create/{subject:name}/{exam:exam_name}', [QuestionController::class,'create'])->name('questions.create');*/
Route::get('/questions/create/{subject:name}', [QuestionController::class,'create'])->name('questions.create');
Route::post('/questions', [QuestionController::class,'store'])->name('questions.store');
Route::get('statistics', [StatisticController::class,'index'])->name('statistics.index');

/*Route::get('/exams/{exam}/questions/create', [QuestionController::class,'create'])->name('exam.questions.create');*/




