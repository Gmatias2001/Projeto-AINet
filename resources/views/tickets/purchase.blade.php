@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-5xl font-bold mb-8">Criar Bilhete para {{ $movie->title }}</h1>
    
    <p class="mb-4">Data da Sessão: {{ $screening->date }}</p>
    
    <form action="{{ route('tickets.purchase.post', ['movie' => $movie->id, 'screening' => $screening->id]) }}" method="POST">
        @csrf
        
        <label for="screening_id">Sessão:</label>
        <select name="screening_id" id="screening_id">
            @foreach ($screenings as $screeningOption)
                @if ($screeningOption->date == $screening->date)
                    <option value="{{ $screeningOption->id }}" {{ $screeningOption->id == $screening->id ? 'selected' : '' }}>
                        {{ $screeningOption->start_time }}
                    </option>
                @endif
            @endforeach
        </select>
        <br>
        
        <label for="seat_id">Lugar:</label>
        <select name="seat_id" id="seat_id">
            @foreach ($seats as $seat)
                <option value="{{ $seat->id }}">Fila {{ $seat->row }}, Assento {{ $seat->seat_number }}</option>
            @endforeach
        </select>
        <br>
        
        <button type="submit" class="bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out">
            Comprar
        </button>
    </form>

</div>
@endsection
