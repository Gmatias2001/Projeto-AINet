@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-5xl font-bold mb-8">Carrinho de Compras</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($tickets->isEmpty())
        <p class="text-lg">Seu carrinho está vazio.</p>
    @else
        <table class="w-full mb-8">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-4">Filme</th>
                    <th class="p-4">Sessão</th>
                    <th class="p-4">Assento</th>
                    <th class="p-4">Preço</th>
                    <th class="p-4">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr class="border-b">
                        <td class="p-4">{{ $ticket->screening->movie->title }}</td>
                        <td class="p-4">{{ $ticket->screening->start_time }}</td>
                        <td class="p-4">{{ $ticket->seat->name }}</td>
                        <td class="p-4">{{ $ticket->price }}</td>
                        <td class="p-4">
                            <form action="{{ route('ticket.remove', ['ticket' => $ticket->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out">
                Finalizar Compra
            </button>
        </form>
    @endif
</div>
@endsection
