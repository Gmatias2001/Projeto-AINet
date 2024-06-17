@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="flex justify-end mb-4">
            <a href="/movieslist/create" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Add New Film</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-purple-100 border border-purple-200">
                <thead>
                    <tr class="bg-purple-300">
                        <th class="py-2 px-4 border-b border-purple-200">
                            <a href="{{ route('movies.index', array_merge(request()->query(), ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" class="sortable-column">
                                ID
                                @if(request('sort') === 'id')
                                    @if(request('direction') === 'asc')
                                        ↑
                                    @else
                                        ↓
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="py-2 px-4 border-b border-purple-200">
                            <a href="{{ route('movies.index', array_merge(request()->query(), ['sort' => 'title', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" class="sortable-column">
                                Title
                                @if(request('sort') === 'title')
                                    @if(request('direction') === 'asc')
                                        ↑
                                    @else
                                        ↓
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="py-2 px-4 border-b border-purple-200">
                            <a href="{{ route('movies.index', array_merge(request()->query(), ['sort' => 'genre_code', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" class="sortable-column">
                                Genre Code
                                @if(request('sort') === 'genre_code')
                                    @if(request('direction') === 'asc')
                                        ↑
                                    @else
                                        ↓
                                    @endif
                                @endif
                            </a>
                        </th>
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
<<<<<<< Updated upstream
                                <a href="/movieslist/{{ $movie->id }}/edit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Update</a>
                                <a href="{{ route('movies.show', ['movie' => $movie]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">View</a> 
=======

                                <a href="{{ route('movies.edit', ['movie' => $movie]) }}" text="Edit" type="primary" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded"> Edit</a>
                                <a href="{{ route('movies.show', ['movie' => $movie]) }}">View</a>
>>>>>>> Stashed changes
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
            {{ $movies->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
