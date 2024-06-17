<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Screening;
use App\Models\Movie;
use App\Models\Theater;

class ScreeningController extends Controller
{
    public function create()
    {
        $movies = Movie::all();
        $theaters = Theater::all();
        return view('screenings.create', compact('movies', 'theaters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'theater_id' => 'required|exists:theaters,id',
            'screening_time' => 'required|date',
        ]);

        $screeningTime = $request->input('screening_time');

        Screening::create([
            'movie_id' => $request->input('movie_id'),
            'theater_id' => $request->input('theater_id'),
            'start_time' => date('H:i:s', strtotime($screeningTime)),
            'date' => date('Y-m-d', strtotime($screeningTime)),
        ]);

        return redirect()->route('screenings.index')->with('success', 'Screening created successfully.');
    }

    public function index(Request $request)
    {
        $sort = $request->query('sort', 'id');
        $direction = $request->query('direction', 'asc');

        $screenings = Screening::with(['movie', 'theater'])
            ->orderBy($sort, $direction)
            ->get();

        return view('screenings.index', compact('screenings', 'sort', 'direction'));
    }

    public function destroy(Screening $screening)
    {
        $screening->delete();

        return redirect()->route('screenings.index')->with('success', 'Screening deleted successfully.');
    }
}
