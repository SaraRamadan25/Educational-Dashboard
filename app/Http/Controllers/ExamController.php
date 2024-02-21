<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

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
        $subjects = Subject::all();
        $questions = Question::all();
        return view('exam.create', compact('subjects', 'questions'));
    }

    /**
     * Store a newly created exam in storage.
     *
     * @param StoreExamRequest $request
     * @return RedirectResponse
     */
    public function store(StoreExamRequest $request): RedirectResponse
    {
        $exam = Exam::create($request->validated());

        $exam->questions()->attach($request->questions);

        return redirect()->route('exams.index')->with('success', 'Exam created successfully.');
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
     * @param UpdateExamRequest $request
     * @param Exam $exam
     * @return RedirectResponse
     */
    public function update(UpdateExamRequest $request, Exam $exam): RedirectResponse
    {
        $validatedData = $request->validated();
        $exam->update($validatedData);

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
        $trashedExams = Exam::onlyTrashed()->paginate(10);
        return view('exam.trashed', ['trashedExams' => $trashedExams]);
    }}
