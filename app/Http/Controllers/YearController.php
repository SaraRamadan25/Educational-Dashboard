<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreYearRequest;
use App\Models\Year;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $years = Year::paginate(10);
        return view('years.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('years.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreYearRequest $request
     * @return RedirectResponse
     */
    public function store(StoreYearRequest $request): RedirectResponse
    {
        Year::create($request->validated());
        return redirect()->route('years.index')->with('success', 'Year added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Year $year
     * @return View
     */
    public function edit(Year $year): View
    {
        return view('years.edit', compact('year'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreYearRequest $request
     * @param Year $year
     * @return RedirectResponse
     */
    public function update(StoreYearRequest $request, Year $year): RedirectResponse
    {
        $year->update($request->validated());
        return redirect()->route('years.index')->with('success', 'Year updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Year $year
     * @return RedirectResponse
     */
    public function destroy(Year $year): RedirectResponse
    {
        $year->delete();
        return redirect()->route('years.index')->with('success', 'Year deleted successfully');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Year $year
     * @return RedirectResponse
     */
    public function restore(Year $year): RedirectResponse
    {
        $year->restore();
        return redirect()->route('years.index')->with('success', 'Year restored successfully');
    }

    /**
     * Display a listing of the trashed resources.
     *
     * @return View
     */
    public function trashed(): View
    {
        $trashedYears = Year::onlyTrashed()->paginate(10);
        return view('years.trashed', compact('trashedYears'));
    }
}
