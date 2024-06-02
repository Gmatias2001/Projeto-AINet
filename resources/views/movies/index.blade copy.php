<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <header>
        <div class="bg-blue-400 flex font-bold">
            <div class="text-4xl m-5">
                CineMagic

            </div>

        </div>
        <div class="bg-slate-900 flex flex-row flex-wrap text-l  text-white font-semibold">
            <div class="ml-3">
                Filmes
            </div>
            <div>
                Cinemas
            </div>
            <div>
                Vantagens
            </div>

        </div>



    </header>
    <body class="bg-gray-100">
        <div class="flex flex-row flex-wrap m-4" >
            <div class=" rounded-3xl shadow-xl bg-slate-400 text-9xl text-blue-500">
                1
            </div>
            <div>
                1
            </div>
            <div>
                1
            </div>
            <div>
                1
            </div>
            <div>
                1
            </div>
            <div>
                1
            </div>
            <div>
                1
            </div>
        </div>


    </body>
    <footer>
        <div class="bg-slate-700 text-gray-400 flex">
            A melhor experiência de cinema nos formatos exclusivos:
            <svg width="100" height="100" href="https://www.cinemas.nos.pt/content/dam/cinemas/icons/screenx_updated.png"> </svg>
        </div>

    </footer>
</html>
