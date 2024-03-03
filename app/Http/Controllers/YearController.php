<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreYearRequest;
use App\Models\Year;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        if ($request->has('trashed')) {
            $years = Year::onlyTrashed()->paginate(10);
            return view('years.trashed', compact('years'));
        }

        $years = Year::paginate(10);
        return view('years.index', compact('years'));
    }
    /**
     * Show the form for creating a new resource.
     * @param Year|null $year
     * @return View
     */
    public function form(Year $year = null): View
    {
        return $year ? view('years.edit', compact('year')) : view('years.create');
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
        if ($year->trashed()) {
            $year->restore();
            $message = 'Year restored successfully';
        } else {
            $year->delete();
            $message = 'Year deleted successfully';
        }

        return redirect()->route('years.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param Year $year
     * @return View
     */
    public function show(Year $year): View
    {
        return view('years.show', compact('year'));
    }
}
