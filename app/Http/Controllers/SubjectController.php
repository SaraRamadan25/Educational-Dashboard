<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Year;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class SubjectController extends Controller
{
    /**
     * Display a listing of the subjects.
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $trashed = $request->get('trashed') === 'true';
        $years = Year::cursor();
        $subjects = Subject::paginate(10);
        $year = $request->get('year');

        if ($year) {
            $semesters = Semester::with('subjects')->where('year_id', $year);
        } else {
            $semesters = Semester::with('subjects');
        }

        $semesters = $trashed ? $semesters->onlyTrashed()->paginate(10) : $semesters->paginate(10);
        $view = $trashed ? 'subjects.trashed' : 'subjects.index';
        $selectedYearId = $request->get('year');
        return view($view, compact('semesters', 'years', 'selectedYearId', 'subjects'));
    }

    /**
     * Show the form for creating a new subjects.
     * @param Subject|null $subject
     * @return View
     */
    public function form(Subject $subject = null): View
    {
        $years = Year::cursor();
        $semesters = Semester::cursor();
        return view('subjects.form', compact('subject', 'semesters', 'years'));
    }

    /**
     * Store a newly created subjects in storage.
     *
     * @param StoreSubjectRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSubjectRequest $request): RedirectResponse
    {
        Subject::create($request->validated());
        return redirect()->route('subjects.index')->with('success', 'Subject added successfully.');
    }


    /**
     * Update the specified subjects in storage.
     *
     * @param StoreSubjectRequest $request
     * @param Subject $subject
     * @return RedirectResponse
     */
    public function update(StoreSubjectRequest $request, Subject $subject): RedirectResponse
    {
        $subject->update($request->validated());
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully');
    }

    /**
     * Remove the specified subjects from storage.
     *
     * @param Subject $subject
     * @return RedirectResponse
     */
    public function destroy(Subject $subject): RedirectResponse
    {
        if ($subject->trashed()) {
            $subject->restore();
            $message = 'Subject restored successfully';
        } else {
            $subject->delete();
            $message = 'Subject deleted successfully';
        }

        return redirect()->route('subjects.index')->with('success', $message);
    }


}
