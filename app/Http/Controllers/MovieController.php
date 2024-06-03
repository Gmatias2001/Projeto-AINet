<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\View\View;

class MovieController extends Controller
{
    public function index(): View
    {
        //$allMovies = Movie::all();
        $allMovies = Movie::paginate(24);
        return view('index')->with('movies', $allMovies);
    }

    public function movieDetail(): View
    {
        //$allMovies = Movie::all();
        $movie = Movie::paginate(1);
        return view('movie')->with('movies', $movie);
    }



}
