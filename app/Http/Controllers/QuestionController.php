<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
class QuestionController extends Controller
{
    public function index(): View|Application|Factory
    {
        $questions = Question::with('subject')->paginate(10);
        return view('question.index', compact('questions'));
    }

    public function create(Subject $subject)
    {
        $subjects = Subject::all();
        return view('question.create', compact('subject', 'subjects'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'question' => 'required|string|max:255',
            'answers' => 'required|array|size:4',
            'is_correct' => 'required|numeric|min:0|max:3',
        ]);

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


