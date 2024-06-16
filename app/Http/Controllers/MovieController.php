<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MovieController extends Controller
{
    public function index(): View
    {
        //$allMovies = Movie::all();
        //$screeningMovies = Screening::paginate(24);
        $screeningMovies = Screening::distinct()->pluck('movie_id');
        $Movies = Movie::whereIn('id', $screeningMovies)->paginate(20);

        return view('index', ['movies' => $Movies]);
    }

    public function details(string $id): View
    {
        $Movie = Movie::findOrFail($id);
        $Screenings = Screening::where('movie_id', $id)->distinct('date')->get(['date']);

        return view('movie_detail', ['movie' => $Movie, 'screenings' => $Screenings]);
    }

    public function lista(): View
    {
        $allMovies = Movie::paginate(20);
        return view('lista')->with('movies', $allMovies);
    }

    public function create(): View
    {
        return view('movies.create');
    }


    public function store(Request $request): RedirectResponse 
{ 
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'genre_code' => 'required|string|max:255',
        'year' => 'required|integer',
        'trailer_url' => 'nullable|url',
        'synopsis' => 'required|string',
        'poster_filename' => 'nullable|file|mimes:jpg,jpeg,png',
    ]);

     //Handle the file upload if there's any
    if ($request->hasFile('poster_filename')) {
        $validatedData['poster_filename'] = $request->file('poster_filename')->store('posters', 'public');
    }

   Movie::create($validatedData); 
    return redirect()->route('movies.index')->with('success', 'Movie added successfully');
}
    
    



public function edit(Movie $movie): View
{
    return view('movies.edit')->with('movie', $movie);
}


public function update(Request $request, Movie $movie): RedirectResponse
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'genre_code' => 'required|string',
        'year' => 'required|integer|min:1888|max:' . date('Y'),
        'trailer_url' => 'nullable|url',
        'synopsis' => 'required|string',
        'poster_filename' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('poster_filename')) {
        $file = $request->file('poster_filename');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('posters'), $filename);
        $validatedData['poster_filename'] = $filename;
    }

    $movie->update($validatedData);
    return redirect('/movies');
}


   


    public function destroy(Movie $movie)
    {
    }
}
