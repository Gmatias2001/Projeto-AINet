@extends('layouts.app')

@section('content')
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Gender Code</th>
                <th>Year</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->id }}</td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->gender_code }}</td>
                    <td>{{ $movie->year }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
