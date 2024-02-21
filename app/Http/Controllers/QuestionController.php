<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionsRequest;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;


class QuestionController extends Controller
{
    /**
     * Display a listing of the questions.
     *
     * @return View
     */
    public function index(): View
    {
        $questions = Question::with('subject')->paginate(10);
        return view('question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new question.
     *
     * @param Request $request
     * @param Subject $subject
     * @param Exam $exam
     * @return View
     */
    public function create(Request $request,Subject $subject, Exam $exam): View
    {
        $subjects = Subject::all();
        $numAnswers = $request->input('num_answers');

        return view('question.create', compact('subject', 'subjects','numAnswers','exam'));
    }

    /**
     * Store a newly created question in storage.
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


        return redirect()->route('questions.index')->with('success', 'Question added successfully.');
    }

    /**
     * Show the form for editing the specified question.
     *
     * @param Question $question
     * @param Request $request
     * @return View
     */
    public function edit(Question $question, Request $request): View
    {
        $subjects = Subject::all();
        return view('question.edit', compact('question', 'subjects'));
    }

    /**
     * Update the specified question in storage.
     *
     * @param UpdateQuestionsRequest $request
     * @param Question $question
     * @return RedirectResponse
     */
    public function update(UpdateQuestionsRequest $request, Question $question): RedirectResponse
    {
        $validatedData = $request->validated();
        $question->update([
            'subject_id' => $validatedData['subject_id'],
            'question' => $validatedData['question'],
        ]);

        return redirect()->route('questions.index')->with('success', 'Question updated successfully');
    }

    /**
     * Remove the specified question from storage.
     *
     * @param Question $question
     * @return RedirectResponse
     */
    public function destroy(Question $question): RedirectResponse
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully');
    }

    /**
     * Display a listing of the trashed questions.
     *
     * @return View
     */
    public function trashed(): View
    {
        $trashedQuestions = Question::onlyTrashed()->paginate(10);
        return view('question.trashed', compact('trashedQuestions'));
    }

    /**
     * Restore the specified question from storage.
     *
     * @param Question $question
     * @return RedirectResponse
     */
    public function restore(Question $question): RedirectResponse
    {
        $question->restore();
        return redirect()->route('questions.index')->with('success', 'Question restored successfully');
    }
}
