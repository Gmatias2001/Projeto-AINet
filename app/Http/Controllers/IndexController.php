<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        //$allMovies = Movie::all();
        $allMovies = Movie::paginate(24);
        return view('index')->with('movies', $allMovies);
    }
}
