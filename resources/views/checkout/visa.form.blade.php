<!-- resources/views/visa.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-5xl font-bold mb-8">Pagamento com Visa</h1>

    <form action="{{ route('visa.process') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="card_number">Número do Cartão:</label>
            <input type="text" id="card_number" name="card_number" required>
        </div>

        <div class="mb-4">
            <label for="cvc_code">Código CVC:</label>
            <input type="text" id="cvc_code" name="cvc_code" required>
        </div>

        <button type="submit" class="bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out">
            Finalizar Pagamento Visa
        </button>
    </form>
</div>
@endsection
