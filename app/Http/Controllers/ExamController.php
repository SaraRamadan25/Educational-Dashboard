<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ExamController extends Controller
{
    /**
     * Display a listing of the exams.
     *
     * @return View
     */
    public function index(): View
    {
        $exams= Exam::paginate(10);
        return view('exam.index',compact('exams'));
    }

    /**
     * Show the form for creating a new exam.
     *
     * @return View
     */
    public function create(): View
    {
        return view('exam.create');
    }

    /**
     * Store a newly created exam in storage.
     *
     * @param StoreQuestionRequest $request
     * @param Exam $exam
     * @return RedirectResponse
     */
    public function store(StoreQuestionRequest $request, Exam $exam): RedirectResponse
    {
        $validatedData = $request->validated();

        $question = Question::create([
            'subject_id' => $validatedData['subject_id'],
            'question' => $validatedData['question'],
        ]);

        foreach ($validatedData['answers'] as $key => $answer) {
            $isCorrect = $key == $validatedData['is_correct'] ? 1 : 0;
            $question->answers()->create([
                'answer' => $answer,
                'is_correct' => $isCorrect,
            ]);
        }

        $exam->questions()->attach($question->id);

        return redirect()->route('questions.index')->with('success', 'Question added successfully.');
    }

    /**
     * Show the form for editing the specified exam.
     *
     * @param Exam $exam
     * @return View
     */
    public function edit(Exam $exam): View
    {
        return view('exam.edit', compact('exam'));
    }

    /**
     * Update the specified exam in storage.
     *
     * @param StoreExamRequest $request
     * @param Exam $exam
     * @return RedirectResponse
     */
    public function update(StoreExamRequest $request, Exam $exam): RedirectResponse
    {
        $validatedData = $request->validated();
        return redirect()->route('exams.index')->with('success', 'Exam updated successfully.');
    }

    /**
     * Remove the specified exam from storage.
     *
     * @param Exam $exam
     * @return RedirectResponse
     */
    public function destroy(Exam $exam): RedirectResponse
    {
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully.');
    }

    /**
     * Display the specified exam.
     *
     * @param Exam $exam
     * @return View
     */
    public function show(Exam $exam): View
    {
        $exam = $exam->load('questions');

        return view('exam.show', compact('exam'));
    }

    /**
     * Restore the specified exam from storage.
     *
     * @param Exam $exam
     * @return RedirectResponse
     */
    public function restore(Exam $exam): RedirectResponse
    {
        $exam->restore();
        return redirect()->route('exams.index')->with('success', 'Exam restored successfully.');
    }

    /**
     * Display a listing of the trashed exams.
     *
     * @return View
     */
    public function trashed(): View
    {
        $exams = Exam::onlyTrashed()->paginate(10);
        return view('exam.trashed', compact('exams'));
    }
}
