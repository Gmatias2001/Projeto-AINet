<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MovieFormRequest;

class MovieController extends Controller
{
    public function index(Request $request): View
    {
        $genre = $request->query('genre');
        $title = $request->query('title');
        $synopsis = $request->query('synopsis');
        $sort = $request->query('sort', 'id');  // Ordenar por 'id' por padrão
        $direction = $request->query('direction', 'asc');  // Ordenar por 'asc' por padrão
        
        // Obter IDs distintos de filmes em exibição
        $screeningMovies = Screening::distinct()->pluck('movie_id');
        
        // Construir a query para os filmes
        $query = Movie::whereIn('id', $screeningMovies);

        // Filtrar por gênero se fornecido
        if ($genre) {
            $query->where('genre_code', $genre);
        }

        // Filtrar por título se fornecido
        if ($title) {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }

        // Filtrar por sinopse se fornecido
        if ($synopsis) {
            $query->where('synopsis', 'LIKE', '%' . $synopsis . '%');
        }

        // Aplicar ordenação
        $query->orderBy($sort, $direction);

        // Obter filmes paginados
        $movies = $query->paginate(20);

        // Obter gêneros únicos
        $genres = Movie::distinct()->pluck('genre_code');

        return view('index', ['movies' => $movies, 'genres' => $genres]);
    }

    public function list(Request $request): View
    {
        $sort = $request->query('sort', 'id');
        $direction = $request->query('direction', 'asc');
        
        $query = Movie::orderBy($sort, $direction);
        
        $movies = $query->paginate(20);

        return view('lista', ['movies' => $movies]);
    }

    public function show(Movie $movie): View     
    {         
        return view('movies.show')->with('movie', $movie);     
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


public function update(MovieFormRequest $request, Movie $movie): RedirectResponse
{
    $movie->update($request->validated());

        if ($request->hasFile('poster_filename')) {
            if ($movie->imageExists) {
                Storage::delete("public/courses/{$movie->poster_filename}");
            }
            $request->image_file->storeAs('public/storage/posters', $movie->poster_filename);
        }

        $url = route('movies.show', ['movie' => $movie]);
        $htmlMessage = "Movie <a href='$url'><u>{$movie->title}</u></a> ({$movie->id}) has been updated successfully!";
        return redirect()->route('movies.show')
            ->with('alert-type', 'success')
            ->with('alert-msg', $htmlMessage);
}





    public function destroy(Movie $movie): RedirectResponse
    {
        $movie->delete();
        return redirect('/movieslist');


    }

<<<<<<< Updated upstream
    
=======
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
>>>>>>> Stashed changes


}
