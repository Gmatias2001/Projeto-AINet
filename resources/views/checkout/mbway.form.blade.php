<!-- resources/views/mbway.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-5xl font-bold mb-8">Pagamento com MBWay</h1>

    <form action="{{ route('mbway.process') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="mbway_number">Número MBWay:</label>
            <input type="text" id="mbway_number" name="mbway_number" required>
        </div>

        <button type="submit" class="bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out">
            Finalizar Pagamento MBWay
        </button>
    </form>
</div>
@endsection
