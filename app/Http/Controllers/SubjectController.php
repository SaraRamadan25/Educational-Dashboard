<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class SubjectController extends Controller
{
    /**
     * Display a listing of the subjects.
     *
     * @return View
     */
    public function index(): View
    {
        $subjects = Subject::with('semester')->paginate(10);
        return view('subject.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new subject.
     *
     * @return View
     */
    public function create(): View
    {
        $semesters = Semester::all();
        return view('subject.create', compact('semesters'));
    }

    /**
     * Store a newly created subject in storage.
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
     * Show the form for editing the specified subject.
     *
     * @param Subject $subject
     * @return View
     */
    public function edit(Subject $subject): View
    {
        $semesters = Semester::all();
        return view('subject.edit', compact('subject', 'semesters'));
    }

    /**
     * Update the specified subject in storage.
     *
     * @param UpdateSubjectRequest $request
     * @param Subject $subject
     * @return RedirectResponse
     */
    public function update(UpdateSubjectRequest $request, Subject $subject): RedirectResponse
    {
        $subject->update($request->validated());
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully');
    }

    /**
     * Remove the specified subject from storage.
     *
     * @param Subject $subject
     * @return RedirectResponse
     */
    public function destroy(Subject $subject): RedirectResponse
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully');
    }

    /**
     * Display a listing of the trashed subjects.
     *
     * @return View
     */
    public function trashed(): View
    {
        $trashedSubjects = Subject::onlyTrashed()->paginate(10);
        return view('subject.trashed', compact('trashedSubjects'));
    }

    /**
     * Restore the specified subject from storage.
     *
     * @param Subject $subject
     * @return RedirectResponse
     */
    public function restore(Subject $subject): RedirectResponse
    {
        $subject->restore();
        return redirect()->route('subjects.index')->with('success', 'Subject restored successfully');
    }
}
