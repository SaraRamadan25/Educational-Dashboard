<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Subject;
use App\Models\Year;
use Illuminate\Contracts\View\View;
class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $yearCount = Year::count();
        $semesterCount = Semester::count();
        $semesters_in_year = Year::withCount('semesters')->get();
        $subjects = Subject::count();
        $years_with_exams = Year::whereHas('semesters.subjects.exams')->get();

        $years_with_subjects = Year::select('years.id', 'years.name')
            ->leftJoin('semesters', 'semesters.year_id', '=', 'years.id')
            ->leftJoin('subjects', 'subjects.semester_id', '=', 'semesters.id')
            ->groupBy('years.id', 'years.name')
            ->selectRaw('count(subjects.id) as subjects_count')
            ->get();

        return view('statistics.index', compact('yearCount', 'semesterCount','semesters_in_year','subjects','years_with_subjects', 'years_with_exams'));
    }
}
