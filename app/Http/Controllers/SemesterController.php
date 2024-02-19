<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSemesterRequest;
use App\Models\Semester;
use App\Models\Year;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
class SemesterController extends Controller
{
    public function index(): View
    {
        $semesters = Semester::with('year')->paginate(10);
        return view('semester.index',compact('semesters'));
    }
    public function create(): View
    {
        $years = Year::all();
        return view('semester.create','years');
    }
    public function store(StoreSemesterRequest $request): RedirectResponse
    {
        Semester::create($request->validated());
        return redirect()->route('semesters.index')->with('success', 'Semester added successfully.');
    }
    public function edit(Semester $semester): View
    {
        $years = Year::all();
        return view('semester.edit', compact('semester','years'));
    }
    public function update(StoreSemesterRequest $request, Semester $semester): RedirectResponse
    {
        $semester->update($request->validated());
        return redirect()->route('semesters.index')->with('success', 'Semester updated successfully');
    }
    public function destroy(Semester $semester): RedirectResponse
    {
        $semester->delete();
        return redirect()->route('semesters.index')->with('success', 'Semester deleted successfully');
    }
    public function trashed(): View
    {
        $trashed = Semester::onlyTrashed()->get();
        return view('semester.trashed', compact('trashed'));
    }
    public function restore(Semester $semester): RedirectResponse
    {
        $semester->restore();
        return redirect()->route('semesters.index')->with('success', 'Semester restored successfully');
    }
}
