<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
class SubjectController extends Controller
{
    public function index():View|Application|Factory
    {
        $subjects = Subject::with('semester')->paginate(10);
        return view('subject.index',compact('subjects'));
    }
}
