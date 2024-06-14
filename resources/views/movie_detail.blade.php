@extends('layouts.app')

@section('content')
    <!--Main-->
    <div class="w-full container mx-auto">
        <div class="w-full h-auto grid grid-flow-col grid-cols-2">
            <div class="w-72 mt-8">
                <img src="{{ $movie->PosterFullUrl }}" alt="" class="rounded-xl " />
            </div>
            <div class="">
                <h1 class="mt-8 text-5xl text-white opacity-75 font-bold leading-tight text-left">
                    {{ $movie->title }}
                </h1>
                <p class="leading-normal text-indigo-400 text-2xl mb-11 text-left">
                    {{ $movie->synopsis }}
                </p>
                <p class="leading-normal text-indigo-400 text-2xl mb-11 text-left">
                    {{ $movie->genre_code }}
                </p>
                <p class="leading-normal text-indigo-400 text-2xl mb-11 text-left">
                    {{ $movie->year }}
                </p>
                <a class="bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                    type="button" href="{{ $movie->trailer_url }}">
                    Trailer
                </a>
            </div>
        </div>
        <p class="mt-8 mb-3 text-5xl text-white opacity-75 font-bold leading-tight text-left">
            Sessões
        </p>
        <div class="flex flex-row flex-wrap gap-5">

            @foreach ($screenings as $screening)
                <a class="bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                    type="button">
                    {{ $screening->date }}
                </a>
            @endforeach
        </div>
    </div>
@endsection

</html>
