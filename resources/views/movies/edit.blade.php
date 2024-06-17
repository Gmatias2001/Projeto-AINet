@extends('layouts.app')

@section('content')
<body>
    <h2>Update Movie {{ $movie->id }}</h2>

    <form method="POST" action="/movieslist/{{ $movie->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $movie->title }}"> 
        </div>
    
        <div>
            <label for="genre_code">Type of genre</label>
            <select name="genre_code" id="genre_code" required>
                <option value="ACTION" {{ $movie->genre_code == 'ACTION' ? 'selected' : '' }}>ACTION</option>
                <option value="ADVENTURE" {{ $movie->genre_code == 'ADVENTURE' ? 'selected' : '' }}>ADVENTURE</option>
                <option value="ANIMATION" {{ $movie->genre_code == 'ANIMATION' ? 'selected' : '' }}>ANIMATION</option>
                <option value="BIOGRAPHY" {{ $movie->genre_code == 'BIOGRAPHY' ? 'selected' : '' }}>BIOGRAPHY</option>
                <option value="COMEDY" {{ $movie->genre_code == 'COMEDY' ? 'selected' : '' }}>COMEDY</option>
                <option value="COMEDY-ACTION" {{ $movie->genre_code == 'COMEDY-ACTION' ? 'selected' : '' }}>COMEDY-ACTION</option>
                <option value="COMEDY-ROMANCE" {{ $movie->genre_code == 'COMEDY-ROMANCE' ? 'selected' : '' }}>COMEDY-ROMANCE</option>
                <option value="CULT" {{ $movie->genre_code == 'CULT' ? 'selected' : '' }}>CULT</option>
                <option value="DRAMA" {{ $movie->genre_code == 'DRAMA' ? 'selected' : '' }}>DRAMA</option>
                <option value="FAMILY" {{ $movie->genre_code == 'FAMILY' ? 'selected' : '' }}>FAMILY</option>
                <option value="FANTASY" {{ $movie->genre_code == 'FANTASY' ? 'selected' : '' }}>FANTASY</option>
                <option value="HISTORY" {{ $movie->genre_code == 'HISTORY' ? 'selected' : '' }}>HISTORY</option>
                <option value="HORROR" {{ $movie->genre_code == 'HORROR' ? 'selected' : '' }}>HORROR</option>
                <option value="MYSTERY" {{ $movie->genre_code == 'MYSTERY' ? 'selected' : '' }}>MYSTERY</option>
                <option value="MUSICAL" {{ $movie->genre_code == 'MUSICAL' ? 'selected' : '' }}>MUSICAL</option>
                <option value="ROMANCE" {{ $movie->genre_code == 'ROMANCE' ? 'selected' : '' }}>ROMANCE</option>
                <option value="SCI-FI" {{ $movie->genre_code == 'SCI-FI' ? 'selected' : '' }}>SCI-FI</option>
                <option value="SUPERHERO" {{ $movie->genre_code == 'SUPERHERO' ? 'selected' : '' }}>SUPERHERO</option>
                <option value="THRILLER" {{ $movie->genre_code == 'THRILLER' ? 'selected' : '' }}>THRILLER</option>
                <option value="WAR" {{ $movie->genre_code == 'WAR' ? 'selected' : '' }}>WAR</option>
                <option value="WESTERN" {{ $movie->genre_code == 'WESTERN' ? 'selected' : '' }}>WESTERN</option>
            </select>
        </div>
        
        <div>
            <label for="year">Year</label>
            <input type="text" name="year" id="year" value="{{ $movie->year }}">
        </div>
        
        <div>
            <label for="trailer_url">Trailer URL</label>
            <input type="text" name="trailer_url" id="trailer_url" value="{{ $movie->trailer_url }}">
        </div>
        
        <div>
            <label for="synopsis">Synopsis</label>
            <textarea name="synopsis" id="synopsis" rows="10" required>{{ $movie->synopsis }}</textarea>
        </div>
        
        <div>
            <label for="poster_filename">Poster</label>
            <input type="file" name="poster_filename" id="poster_filename">
            @if ($movie->poster_filename)
                <p>Current poster: {{ $movie->poster_filename }}</p>
            @endif
        </div>
        
        <div>
            <button type="submit">Save changes</button>
        </div>
    </form>
</body>
@endsection