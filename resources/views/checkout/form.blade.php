<!-- resources/views/compra/formulario.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-5xl font-bold mb-8">Finalizar Compra</h1>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>

        <div class="mb-4">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="mb-4">
            <label for="nif">NIF:</label>
            <input type="text" id="nif" name="nif">
        </div>

        <div class="mb-4">
            <label for="tipo_pagamento">Tipo de Pagamento:</label>
            <select id="tipo_pagamento" name="tipo_pagamento" required>
                <option value="visa">Visa</option>
                <option value="paypal">PayPal</option>
                <option value="mbway">MBWay</option>
            </select>
        </div>

        <button type="submit">Avançar</button>
    </form>
</div>
@endsection
