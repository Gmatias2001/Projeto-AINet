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
    <form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="inputTitle">Title</label>
            <input type="text" name="name" id="inputTitle">
        </div>
    
        <div>
            <label for="inputType">Type of genre</label>
            <select name="type" id="inputGenre">
            <option>ACTION</option>
                <option>ADVENTURE</option>
                <option>ANIMATION</option>
                <option>BIBLOGRAPHY</option>
                <option>COMEDY</option>
                <option>COMEDY-ACTION</option>
                <option>COMEDY-ROMANCE</option>
                <option>CULT</option>
                <option>DRAMA</option>
                <option>CULT</option>
                <option>FAMILY</option>
                <option>FANTASY</option>
                <option>HISTORY</option>
                <option>HORROR</option>
                <option>MISTERY</option>
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
            <label for="inputYear">Year</label>
            <input type="text" name="years" id="inputYears">
        </div>
        
        <div>
            <label for="inputTrailer_url">Trailer</label>
            <input type="text" name="trailer" id="inputTrailer">
        </div>
        
        <div>
            <label for="inputSynopses">Synopsis</label>
            <textarea name="synopsis" id="inputSynopses" rows="10"></textarea>
        </div>
        
        <div>
            <label for="inputPoster">Poster</label>
            <input type="file" name="poster" id="inputPoster">
        </div>
        
        <div>
            <button type="submit">Save new movie</button>
        </div>
    </form>
</body>
</html>

        

    </form>
</body>
</html>
