<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CineMagic</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="leading-normal tracking-normal bg-cover bg-fixed" style="background-image: url('./header.png');">
    <div class="h-full">
        <!--Nav-->
        <div class="w-full my-6 container mx-auto">
            <div class="flex items-center justify-between">
                <a class="flex  text-indigo-400 font-bold text-4xl" href="#">
                    Cine<span
                        class="h-16 bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500">Magic</span>
                </a>
                <a class="flex items-center text-indigo-400 no-underline hover:no-underline font-bold text-2xl"
                    href="/login">
                    Login
                </a>
            </div>
        </div>

        <!--Main-->
        <div class="w-full container mx-auto">
            <!--Filmes-->
            <div class="justify-center">
                <h1 class="mt-8 text-5xl text-white opacity-75 font-bold leading-tight text-left">
                    Filmes em exibição
                </h1>
                <p class="leading-normal text-indigo-400 text-2xl mb-11 text-left">
                    Ainda não sei o que escrever aqui, mas vou descobrir!
                </p>
            </div>
        </div>

        <div class="w-full container mx-auto grid grid-cols-4 gap-7">
            @foreach ($movies as $movie)
                <div class="w-64 h-96 bg-gray-900 opacity-75 shadow-lg rounded-lg">
                    <div class="flex-none w-64 h-96 relative">
                        <img src="https://cdn.nos.pt/cinemas/movies/files/700x1000/7785bee1-cdee-432c-a51c-5cdfac29c869_Image.jpg"
                            alt="" class="absolute inset-0 w-full h-full object-cover rounded-lg"
                            loading="lazy" />
                    </div>
                    <div class="">


                            <a
                                class="hidden hover:visible w-full flex-none mt-2 order-1 text-3xl font-bold text-blue-300">
                                {{ $movie->title }}
                            </a>



                    </div>

                </div>
            @endforeach

        </div>






    </div>
    </div>


    <!--Footer-->
    <div class="w-full my-14 container mx-auto flex items-center justify-between">
        <a class="justify-start text-gray-500 ">Projeto AINet 2024</a>
        <div class="justify-end flex flex-row space-x-4 content-center">
            <a class=" text-blue-300 no-underline hover:text-pink-500 hover:text-underline text-center transform hover:scale-125 duration-300 ease-in-out"
                href="https://twitter.com/intent/tweet?url=#">
                <svg class="fill-current h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                    <path
                        d="M30.063 7.313c-.813 1.125-1.75 2.125-2.875 2.938v.75c0 1.563-.188 3.125-.688 4.625a15.088 15.088 0 0 1-2.063 4.438c-.875 1.438-2 2.688-3.25 3.813a15.015 15.015 0 0 1-4.625 2.563c-1.813.688-3.75 1-5.75 1-3.25 0-6.188-.875-8.875-2.625.438.063.875.125 1.375.125 2.688 0 5.063-.875 7.188-2.5-1.25 0-2.375-.375-3.375-1.125s-1.688-1.688-2.063-2.875c.438.063.813.125 1.125.125.5 0 1-.063 1.5-.25-1.313-.25-2.438-.938-3.313-1.938a5.673 5.673 0 0 1-1.313-3.688v-.063c.813.438 1.688.688 2.625.688a5.228 5.228 0 0 1-1.875-2c-.5-.875-.688-1.813-.688-2.75 0-1.063.25-2.063.75-2.938 1.438 1.75 3.188 3.188 5.25 4.25s4.313 1.688 6.688 1.813a5.579 5.579 0 0 1 1.5-5.438c1.125-1.125 2.5-1.688 4.125-1.688s3.063.625 4.188 1.813a11.48 11.48 0 0 0 3.688-1.375c-.438 1.375-1.313 2.438-2.563 3.188 1.125-.125 2.188-.438 3.313-.875z">
                    </path>
                </svg>
            </a>
            <a class="text-blue-300 no-underline hover:text-pink-500 hover:text-underline text-center transform hover:scale-125 duration-300 ease-in-out"
                href="https://www.facebook.com/sharer/sharer.php?u=#">
                <svg class="fill-current h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                    <path d="M19 6h5V0h-5c-3.86 0-7 3.14-7 7v3H8v6h4v16h6V16h5l1-6h-6V7c0-.542.458-1 1-1z">
                    </path>
                </svg>
            </a>
        </div>
    </div>
    </div>
</body>

</html>