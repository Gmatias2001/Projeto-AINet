@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold mb-4">{{ $movie->title }}</h2>
            <div>
                <img src="{{ asset('posters/' . $movie->poster_filename) }}" alt="Movie Poster" class="rounded-lg">
            </div>
            <div>
                <p><span class="font-bold">ID:</span> {{ $movie->id }}</p>
                <p><span class="font-bold">Genre Code:</span> {{ $movie->genre_code }}</p>
                <p><span class="font-bold">Year:</span> {{ $movie->year }}</p>
                <p><span class="font-bold">Trailer URL:</span> <a href="{{ $movie->trailer_url }}" target="_blank" class="text-blue-500 hover:underline">{{ $movie->trailer_url }}</a></p>
                <p class="mt-4"><span class="font-bold">Synopsis:</span> {{ $movie->synopsis }}</p>
            </div>
            <div class="mt-4">
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" onclick="goBack()">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3.707 9.293a1 1 0 0 1 0-1.414l7-7a1 1 0 0 1 1.414 1.414L6.414 9H17a1 1 0 1 1 0 2H6.414l5.707 5.707a1 1 0 0 1-1.414 1.414l-7-7z" clip-rule="evenodd" />
                    </svg>
                    Back
                </button>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection