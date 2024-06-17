@extends('layouts.app')

@section('content')
    <!--Main-->
    <div class="w-full container mx-auto">
        <!--Filmes-->
        <div class="justify-center">
            <h1 class="mt-8 text-5xl text-white opacity-75 font-bold leading-tight text-left">
                Filmes em exibição
            </h1>
            <p class="leading-normal text-indigo-400 text-2xl mb-11 text-left">
                Vive a magia do Cinema!
            </p>
        </div>

        <!-- Barra de Pesquisa -->
        <div class="w-full mb-6">
            <form method="GET" action="{{ route('home') }}" class="flex">
                <input type="text" name="title" placeholder="Digite o título" class="border border-gray-300 p-2 rounded-lg mr-2" value="{{ request('title') }}">
                <input type="text" name="synopsis" placeholder="Digite a sinopse" class="border border-gray-300 p-2 rounded-lg mr-2" value="{{ request('synopsis') }}">
                <select name="genre" class="border border-gray-300 p-2 rounded-lg mr-2">
                    <option value="">Todos os Gêneros</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>{{ $genre }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg">Filtrar</button>
            </form>
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
    <div class="mt-4">
        {{ $movies->appends(request()->query())->links() }}
    </div>
@endsection
