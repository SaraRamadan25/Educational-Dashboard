<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
class SubjectController extends Controller
{
    public function index():View
    {
        $subjects = Subject::with('semester')->paginate(10);
        return view('subject.index',compact('subjects'));
    }
    public function create():View
    {
        return view('subject.create');
    }
    public function store(Request $request): RedirectResponse
    {
        Subject::create($request->validated());
        return redirect()->route('subjects.index')->with('success', 'Subject added successfully.');
    }

    public function edit(Subject $subject): View
    {
        return view('subject.edit', compact('subject'));
    }
    public function update(Request $request, Subject $subject): RedirectResponse
    {
        $subject->update($request->validated());
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully');
    }
    public function destroy(Subject $subject): RedirectResponse
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully');
    }
    public function trashed(): View
    {
        $trashedSubjects = Subject::onlyTrashed()->paginate(10);
        return view('subject.trashed', compact('trashedSubjects'));
    }
    public function restore(Subject $subject): RedirectResponse
    {
        $subject->restore();
        return redirect()->route('subjects.index')->with('success', 'Subject restored successfully');
    }
}
