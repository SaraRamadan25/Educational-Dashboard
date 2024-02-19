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
    public function index(): View
    {
        $years = Year::paginate(10);
        return view('years.index', compact('years'));
    }
    public function create(): View
    {
        return view('years.create');
    }
    public function store(StoreYearRequest $request): RedirectResponse
    {
        Year::create($request->validated());
        return redirect()->route('years.index')->with('success', 'Year added successfully.');
    }
    public function edit(Year $year): View
    {
        return view('years.edit', compact('year'));
    }
    public function update(StoreYearRequest $request, Year $year): RedirectResponse
    {
        $year->update($request->validated());
        return redirect()->route('years.index')->with('success', 'Year updated successfully');
    }
    public function destroy(Year $year): RedirectResponse
    {
        $year->delete();
        return redirect()->route('years.index')->with('success', 'Year deleted successfully');
    }
    public function restore(Year $year): RedirectResponse
    {
        $year->restore();
        return redirect()->route('years.index')->with('success', 'Year restored successfully');
    }
    public function trashed(): View
    {
        $trashedYears = Year::onlyTrashed()->paginate(10);
        return view('years.trashed', compact('trashedYears'));
    }

}
