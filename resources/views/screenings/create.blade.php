@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold">Create Screening</h2>
        <form method="POST" action="{{ route('screenings.store') }}">
            @csrf
            <div>
                <label for="movie_id">Movie</label>
                <select name="movie_id" id="movie_id" required>
                    @foreach($movies as $movie)
                        <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="theater_id">Theater</label>
                <select name="theater_id" id="theater_id" required>
                    @foreach($theaters as $theater)
                        <option value="{{ $theater->id }}">{{ $theater->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="screening_time">Screening Time</label>
                <input type="datetime-local" name="screening_time" id="screening_time" required>
            </div>
            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Screening</button>
            </div>
        </form>
    </div>
@endsection