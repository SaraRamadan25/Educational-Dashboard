<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
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
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $trashed = $request->get('trashed') === 'true';
        $questions = $trashed ? Question::onlyTrashed()->paginate(10) : Question::paginate(10);

        $view = $trashed ? 'questions.trashed' : 'questions.index';
        return view($view, compact('questions'));
    }

    /**
     * Show the form for creating a new questions.
     * @param Question|null $question
     * @return View
     */

    public function form(Question $question = null): View
    {
        $subjects = Subject::cursor();
        return view('questions.form', compact('question', 'subjects'));
    }

    /**
     * Store a newly created questions in storage.
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
     * Show the form for editing the specified questions.
     *
     * @param Question $questions
     * @param Request $request
     * @return View
     */

    /**
     * Update the specified questions in storage.
     *
     * @param StoreQuestionRequest $request
     * @param Question $question
     * @return RedirectResponse
     */
    public function update(StoreQuestionRequest $request, Question $question): RedirectResponse
    {
        $validatedData = $request->validated();
        $question->update([
            'subject_id' => $validatedData['subject_id'],
            'questions' => $validatedData['questions'],
        ]);

        return redirect()->route('questions.index')->with('success', 'Question updated successfully');
    }

    /**
     * Remove the specified questions from storage.
     *
     * @param Question $question
     * @return RedirectResponse
     */
    public function destroy(Question $question): RedirectResponse
    {
        if ($question->trashed()) {
            $question->restore();
            $message = 'Question restored successfully';
        } else {
            $question->delete();
            $message = 'Question deleted successfully';
        }

        return redirect()->route('questions.index')->with('success', $message);
    }

}
