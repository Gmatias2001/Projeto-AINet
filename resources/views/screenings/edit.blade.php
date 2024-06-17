@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold">Edit Screening</h2>
        <form method="POST" action="{{ route('screenings.update', $screening->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="movie_id" class="block text-gray-700">Movie</label>
                <select name="movie_id" id="movie_id" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    @foreach($movies as $movie)
                        <option value="{{ $movie->id }}" {{ $screening->movie_id == $movie->id ? 'selected' : '' }}>
                            {{ $movie->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="theater_id" class="block text-gray-700">Theater</label>
                <select name="theater_id" id="theater_id" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    @foreach($theaters as $theater)
                        <option value="{{ $theater->id }}" {{ $screening->theater_id == $theater->id ? 'selected' : '' }}>
                            {{ $theater->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="screening_time" class="block text-gray-700">Screening Time</label>
                <input type="datetime-local" name="screening_time" id="screening_time" value="{{ date('Y-m-d\TH:i', strtotime($screening->date . ' ' . $screening->start_time)) }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Screening</button>
            </div>
        </form>
    </div>
@endsection