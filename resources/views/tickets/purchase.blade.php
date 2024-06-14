@extends('layouts.app')

@section('content')
    <h1>Selecione a Sessão e o Lugar</h1>
    <form action="{{ route('tickets.purchase.post') }}" method="POST">
        @csrf
        <label for="screening_id">Sessão:</label>
        <select name="screening_id" id="screening_id">
            @foreach ($screenings as $screening)
                <option value="{{ $screening->id }}"> - {{ $screening->start_time }}</option>
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
        <button type="submit">Comprar</button>
    </form>
@endsection
