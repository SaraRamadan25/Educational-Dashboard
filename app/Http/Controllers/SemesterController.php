<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSemesterRequest;
use App\Models\Semester;
use App\Models\Year;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $trashed = $request->get('trashed') === 'true';
        $semesters = $trashed ? Semester::onlyTrashed()->paginate(10) : Semester::paginate(10);
        $view = $trashed ? 'semesters.trashed' : 'semesters.index';
        return view($view, compact('semesters'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Semester|null $semester
     * @return View
     */
    public function form(Semester $semester = null): View
    {
        $years = Year::cursor();
        return view('semesters.form', compact('semester', 'years'));
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
        if ($semester->trashed()) {
            $semester->restore();
            $message = 'Semester restored successfully';
        } else {
            $semester->delete();
            $message = 'Semester deleted successfully';
        }

        return redirect()->route('semesters.index')->with('success', $message);
    }

}
