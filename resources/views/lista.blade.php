@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="flex justify-end mb-4">
            <a href="movieslist/create" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Add New Film</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-purple-100 border border-purple-200">
                <thead>
                    <tr class="bg-purple-300">
                        <th class="py-2 px-4 border-b border-purple-200">ID</th>
                        <th class="py-2 px-4 border-b border-purple-200">Title</th>
                        <th class="py-2 px-4 border-b border-purple-200">Genre Code</th>
                        <th class="py-2 px-4 border-b border-purple-200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                        <tr class="hover:bg-purple-200">
                            <td class="py-2 px-4 border-b border-purple-200">{{ $movie->id }}</td>
                            <td class="py-2 px-4 border-b border-purple-200">{{ $movie->title }}</td>
                            <td class="py-2 px-4 border-b border-purple-200">{{ $movie->genre_code }}</td>
                            <td class="py-2 px-4 border-b border-purple-200 flex space-x-2">
                                <a href="/movieslist/{{ $movie->id }}/edit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Update</a>
                                <a href="{{ route('movies.show', ['movie' => $movie]) }}">View</a> 
                                <form method="POST" action="{{ route('movies.destroy', ['movie' => $movie]) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="delete" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $movies->links() }}
        </div>
    </div>
@endsection
