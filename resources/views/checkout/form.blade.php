@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-5xl font-bold mb-8">Finalizar Compra</h1>

    @php
        $cart = session('cart', []);
        $ticket_price = 9.0;
        $total = count($cart) * $ticket_price;
        $user = Auth::user();
        if ($user) {
            $total *= 0.9; // Aplicar 10% de desconto para usuários autenticados
        }
    @endphp
    
    <p class="mb-4">Total a pagar: {{ number_format($total, 2) }} €</p>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome"value="{{ $user ? $user->name : '' }}" required>
        </div>

        <div class="mb-4">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user ? $user->email : '' }}" required>
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

        <div id="payment_fields" class="payment-fields mb-4" style="display: none;">
            <label for="ref_pagamento">Referência de Pagamento:</label>
            <input type="text" id="ref_pagamento" name="ref_pagamento" maxlength="255" required>
        </div>

        <div id="cvc_field" class="mb-4" style="display: none;">
            <label for="cvc_code">Código CVC:</label>
            <input type="text" id="cvc_code" name="cvc_code" minlength="3" maxlength="3" required>
        </div>
        <button type="submit" class="bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out">
        Finalizar Pagamento
        </button>
    </form>
</div>

<script>
    // Mostra os campos específicos dependendo do tipo de pagamento selecionado
    document.getElementById('tipo_pagamento').addEventListener('change', function () {
        var paymentType = this.value;
        if (paymentType === 'visa') {
            document.getElementById('payment_fields').style.display = 'block';
            document.getElementById('cvc_field').style.display = 'block';
            document.getElementById('ref_pagamento').placeholder = 'Número do Cartão Visa';
        } else if (paymentType === 'paypal') {
            document.getElementById('payment_fields').style.display = 'block';
            document.getElementById('cvc_field').style.display = 'block';
            document.getElementById('ref_pagamento').placeholder = 'Email do PayPal';
        } else if (paymentType === 'mbway') {
            document.getElementById('payment_fields').style.display = 'block';
            document.getElementById('cvc_field').style.display = 'block';
            document.getElementById('ref_pagamento').placeholder = 'Número MBWay';
        } else {
            document.getElementById('payment_fields').style.display = 'none';
            document.getElementById('cvc_field').style.display = 'none';
        }
    });
</script>
@endsection
