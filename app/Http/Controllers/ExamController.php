<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the exams.
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $trashed = $request->get('trashed') === 'true';
        $exams = $trashed ? Exam::onlyTrashed()->paginate(10) : Exam::paginate(10);
        $view = $trashed ? 'exams.trashed' : 'exams.index';
        return view($view, compact('exams'));
    }

    /**
     * Show the form for creating a new exams.
     * @param Exam|null $exam
     * @return View
     */

    public function form(Exam $exam = null): View
    {
        $subjects = Subject::cursor();
        $questions = Question::paginate(10);
        return view('exams.form', compact('exam', 'subjects', 'questions'));
    }

    /**
     * Store a newly created exams in storage.
     *
     * @param  StoreExamRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreExamRequest $request): RedirectResponse
    {
        $exam = Exam::create($request->validated());

        $exam->questions()->attach($request->selected_questions);

        return redirect()->route('exams.index')->with('success', 'Exam created successfully.');
    }
    /**
     * Show the form for editing the specified exams.
     *
     * @param  Exam  $exams
     * @return View
     */

    /**
     * Update the specified exams in storage.
     *
     * @param  StoreExamRequest  $request
     * @param  Exam  $exam
     * @return RedirectResponse
     */
    public function update(StoreExamRequest $request, Exam $exam): RedirectResponse
    {
        $exam->update($request->validated());

        $exam->questions()->attach($request->selected_questions);

        return redirect()->route('exams.index')->with('success', 'Exam updated successfully.');
    }
    /**
     * Remove the specified exams from storage.
     *
     * @param  Exam  $exam
     * @return RedirectResponse
     */
    public function destroy(Exam $exam): RedirectResponse
    {
        if ($exam->trashed()) {
            $exam->restore();
            $message = 'Exam restored successfully';
        } else {
            $exam->delete();
            $message = 'Exam deleted successfully';
        }

        return redirect()->route('exams.index')->with('success', $message);
    }

    /**
     * Display the specified exams.
     *
     * @param  Exam  $exam
     * @return View
     */
    public function show(Exam $exam): View
    {
        $exam = $exam->load('questions');

        return view('exams.show', compact('exam'));
    }

}
