<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>
    <h2>New Movie</h2>
    <form method="POST" action="{{ route('movies.store') }}">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title">
        </div>
    
        <div>
            <label for="genre_code">Type of genre</label>
            <select name="genre_code" id="genre_code">
                <option>ACTION</option>
                <option>ADVENTURE</option>
                <option>ANIMATION</option>
                <option>BIBLIOGRAPHY</option>
                <option>COMEDY</option>
                <option>COMEDY-ACTION</option>
                <option>COMEDY-ROMANCE</option>
                <option>CULT</option>
                <option>DRAMA</option>
                <option>FAMILY</option>
                <option>FANTASY</option>
                <option>HISTORY</option>
                <option>HORROR</option>
                <option>MYSTERY</option>
                <option>MUSICAL</option>
                <option>ROMANCE</option>
                <option>SCI-FI</option>
                <option>SUPERHERO</option>
                <option>THRILLER</option>
                <option>WAR</option>
                <option>WESTERN</option>
            </select>
        </div>
        
        <div>
            <label for="year">Year</label>
            <input type="text" name="year" id="year">
        </div>
        
        <div>
            <label for="trailer_url">Trailer</label>
            <input type="text" name="trailer_url" id="trailer_url">
        </div>
        
        <div>
            <label for="synopsis">Synopsis</label>
            <textarea name="synopsis" id="synopsis" rows="10"></textarea>
        </div>
        
        <div>
            <label for="poster_filename">Poster</label>
            <input type="file" name="poster_filename" id="poster_filename">
        </div>
        
        <div>
            <button type="submit">Save new movie</button>
        </div>
    </form>
</body>
</html>
