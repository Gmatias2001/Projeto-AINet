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
    Movie::create($request->all());
    return redirect('/movieslist');
        
     
    if ($request->hasFile('poster_filename')) {
        $validatedData['poster_filename'] = $request->file('poster_filename')->store('posters', 'public');
    } 
  
}
    
    



public function edit(Movie $movie): View
{
    return view('movies.edit')->with('movie', $movie);
}


public function update(Request $request, Movie $movie): RedirectResponse
{
    $movie->update($request->all()); 
    return redirect('/movies'); 
}


   


    public function destroy(Movie $movie): RedirectResponse
    {
        $movie->delete();     
        return redirect('/movieslist'); 


    }

    public function show(Movie $movie): View     
    {         
        return view('movies.show')->with('movie', $movie);     
    } 

    public function search(Request $request)
{
    $query = $request->input('query');

    // Perform search logic, for example:
    $movies = Movie::where('title', 'like', '%' . $query . '%')->get();

    return view('movies.index', [
        'movies' => $movies,
        'query' => $query, // Pass query to re-populate search field if needed
    ]);
}


}
