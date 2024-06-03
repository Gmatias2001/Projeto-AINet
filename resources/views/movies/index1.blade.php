<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=albert-sans:100,200,300,400,500,600,700,800,900" rel="stylesheet" />



        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <header>
        <div class="bg-white border-b border-gray-100">
            <div >
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <svg >

                            </svg>
                        </div>

                        <!-- Navigation Links -->
                        <div class="inline-flex items-center px-3 pt-1 border-b-2 border-transparent text-lg  leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <a  href="dashboard" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </a>
                        </div>
                        <div class="inline-flex items-center px-3 pt-1 border-b-2 border-indigo-400 text-lg leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                            <a>
                                {{ __('Movies') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <body>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Genre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movies as $movie)
                                <tr>
                                    <td>{{ $movie->title}}</td>
                                    <td>{{ $movie->genre_code}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
