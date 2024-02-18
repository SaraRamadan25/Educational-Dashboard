<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function index(): View|Application|Factory
    {
        $years = Year::paginate(10);
        return view('year.index',compact('years'));
    }
}
