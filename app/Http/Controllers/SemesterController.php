<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSemesterRequest;
use App\Models\Semester;
use App\Models\Year;
use Illuminate\Http\JsonResponse;
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
        if ($request->has('trashed')) {
            $semesters = Year::onlyTrashed()->paginate(10);
            return view('semesters.trashed', compact('semesters'));
        }

        $semesters = Semester::paginate(10);
        return view('semesters.index', compact('semesters'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Semester|null $semester
     * @return View
     */
    public function form(Semester $semester = null): View
    {
        $years = Year::cursor();
        return $semester ? view('semesters.edit', compact('semester')) : view('semesters.create', compact('years'));
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
    public function getSemestersByYear(Year $year): JsonResponse
    {
        $semesters = $year->semesters()->pluck('name', 'id');
        return response()->json($semesters);
    }
}
