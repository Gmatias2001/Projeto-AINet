<!-- resources/views/paypal.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-5xl font-bold mb-8">Pagamento com PayPal</h1>

    <form action="{{ route('paypal.process') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="paypal_email">Email do PayPal:</label>
            <input type="email" id="paypal_email" name="paypal_email" required>
        </div>

        <button type="submit" class="bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out">
            Finalizar Pagamento PayPal
        </button>
    </form>
</div>
@endsection
