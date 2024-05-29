<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies</title>
    <style>
        table,
        th,
        td {
           border: 1px solid black;
         border-cosllapse: collapse;      
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)    
                <tr>
                <td>{{ $movie->title}}</td>
                <td>{{ $movie->genre_code}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>