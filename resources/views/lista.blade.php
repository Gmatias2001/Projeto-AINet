@extends('layouts.app')

@section('content')
    <div class="button-container">
        <a href="movieslist/create" class="btn btn-primary">Add New Film</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Gender Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->id }}</td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->genre_code }}</td>
                    <td>                         
                        <a href="/movieslist/{{$movie->id}}/edit">Update</a>                     
                    </td> 
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
{{ $movies->links() }}
</div>
@endsection
