<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSemesterRequest;
use App\Models\Semester;
use App\Models\Year;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $semesters = Semester::with('year')->paginate(10);
        return view('semester.index',compact('semesters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $years = Year::all();
        return view('semester.create',compact('years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSemesterRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSemesterRequest $request): RedirectResponse
    {
        Semester::create($request->validated());
        return redirect()->route('semesters.index')->with('success', 'Semester added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Semester $semester
     * @return View
     */
    public function edit(Semester $semester): View
    {
        $years = Year::all();
        return view('semester.edit', compact('semester','years'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreSemesterRequest $request
     * @param Semester $semester
     * @return RedirectResponse
     */
    public function update(StoreSemesterRequest $request, Semester $semester): RedirectResponse
    {
        $semester->update($request->validated());
        return redirect()->route('semesters.index')->with('success', 'Semester updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Semester $semester
     * @return RedirectResponse
     */
    public function destroy(Semester $semester): RedirectResponse
    {
        $semester->delete();
        return redirect()->route('semesters.index')->with('success', 'Semester deleted successfully');
    }

    /**
     * Display a listing of the trashed resources.
     *
     * @return View
     */
    public function trashed(): View
    {
        $trashedSemesters = Semester::onlyTrashed()->paginate(10);
        return view('semester.trashed', compact('trashedSemesters'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Semester $semester
     * @return RedirectResponse
     */
    public function restore(Semester $semester): RedirectResponse
    {
        $semester->restore();
        return redirect()->route('semesters.index')->with('success', 'Semester restored successfully');
    }
}
