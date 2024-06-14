@extends('layouts.app')

@section('content')
    <!--Main-->
    <div class="w-full container mx-auto">
        <!-- Title and Button -->
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="mt-8 text-5xl text-white opacity-75 font-bold leading-tight">
                    CineMagic
                </h1>
                <a href="/outra-pagina" class="ml-4">
                    <button class="new-button mt-8 text-white opacity-75 font-bold leading-tight">
                        Outra página
                    </button>
                </a>
            </div>
        </div>
        <!-- Filmes -->
        <div class="justify-center">
            <h1 class="mt-8 text-5xl text-white opacity-75 font-bold leading-tight text-left">
                Filmes em exibição
            </h1>
            <p class="leading-normal text-indigo-400 text-2xl mb-11 text-left">
                Vive a magia do Cinema!
            </p>
        </div>
    </div>

    <div class="w-full container mx-auto grid grid-cols-3 gap-14 md:grid-cols-4">
        @foreach ($movies as $movie)
            <a href="/movie/{{ $movie->id }}">
                <div class="size-auto rounded-md focus:ring transform transition hover:scale-105 duration-300 ease-in-out">
                    <img src="{{ $movie->PosterFullUrl }}" alt="" class="w-full h-full rounded-xl" loading="lazy" />
                </div>
            </a>
        @endforeach
    </div>
@endsection