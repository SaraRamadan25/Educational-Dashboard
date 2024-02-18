<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Subject;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
class StatisticController extends Controller
{
    public function index(): View|Application|Factory
    {
        $yearCount = Year::count();
        $semesterCount = Semester::count();
        $semesters_in_year = Year::withCount('semesters')->get();
        $subjects = Subject::count();
        $years_with_exams = Year::whereHas('semesters.subjects.exams')->get();

        $years_with_subjects = Year::select('years.id', 'years.name')
            ->join('semesters', 'semesters.year_id', '=', 'years.id')
            ->join('subjects', 'subjects.semester_id', '=', 'semesters.id')
            ->groupBy('years.id', 'years.name')
            ->selectRaw('count(subjects.id) as subjects_count')
            ->get();


        return view('statistic.index', compact('yearCount', 'semesterCount','semesters_in_year','subjects','years_with_subjects', 'years_with_exams'));
    }
}
