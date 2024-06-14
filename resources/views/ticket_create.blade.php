@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-5xl font-bold mb-8">Criar Bilhete para {{ $movie->title }}</h1>
    
    <p class="mb-4">Data da Sessão: {{ $screening->date }}</p>
    <p class="mb-4">Horário: {{ $screening->start_time }}</p>
    
    <form action="{{ route('ticket.add', ['screening' => $screening->id, 'seat' => 1]) }}" method="POST">
    @csrf
        <div class="mb-4">
            <label for="seat" class="block text-sm font-medium text-gray-700">Escolha o Assento:</label>
            <select id="seat" name="seat" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
             <!--   @foreach($seats as $seat)
                    <option value="{{ $seat->id }}">{{ $seat->row }}{{ $seat->seat_number }}</option>
                @endforeach-->
            </select>
        </div>
        <button type="submit" class="bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out">
            Adicionar ao Carrinho
        </button>
    </form>
</div>
@endsection
