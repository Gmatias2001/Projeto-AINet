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

    public function details(string $id): View
    {
        $movie = Movie::findOrFail($id);
        //dd($movie);
        return view('movie_detail')->with('movie', $movie);
    }

    public function create(): View
    {
        $newMovie = new Movie();
        return view ('movies.create')->with('movie', $newMovie);
    }


    public function store(Request $request)
    {

    }



    public function edit(Movie $movie)
    {

    }


    public function update(Request $request, Movie $movie)
    {

    }


    public function destroy(Movie $movie)
    {

    }


}
