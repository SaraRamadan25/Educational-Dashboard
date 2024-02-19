<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
class ExamController extends Controller
{
    public function index(): View
    {
        $exams= Exam::paginate(10);
        return view('exam.index',compact('exams'));
    }


}
