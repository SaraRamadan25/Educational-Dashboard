<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
class QuestionController extends Controller
{
    public function index(): View
    {
        $questions = Question::with('subject')->paginate(10);
        return view('question.index', compact('questions'));
    }

    public function create(Request $request,Subject $subject): View
    {
        $subjects = Subject::all();
        $numAnswers = $request->input('num_answers');

        return view('question.create', compact('subject', 'subjects','numAnswers'));
    }

    public function store(StoreQuestionRequest $request): RedirectResponse
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

}


