<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
class SemesterController extends Controller
{
    public function index(): View|Application|Factory
    {
        $semesters = Semester::with('year')->paginate(10);
        return view('semester.index',compact('semesters'));
    }
}
