@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-5xl font-bold mb-8">Seu Carrinho</h1>

    @if (session('alert-msg'))
    <div class="alert {{ session('alert-type', 'alert-info') }}">
        {!! session('alert-msg') !!}
    </div>
    @endif

    @if ($cart->isEmpty())
    <p>O carrinho está vazio.</p>
    @else
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2">Filme</th>
                <th class="py-2">Assento</th>
                <th class="py-2">Data</th>
                <th class="py-2">Hora</th>
                <th class="py-2">QR Code</th>
                <th class="py-2">Ação</th> <!-- Adicionei uma coluna para a ação -->
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
            <tr>
                <th class="py-2">{{ $item->screening->movie->title }}</th> <!-- Ajuste para acessar os relacionamentos -->
                <th class="py-2">Fila {{ $item->seat->row }}, Assento {{ $item->seat->seat_number }}</th> <!-- Mostra o assento -->
                <th class="py-2">{{ $item->screening->date }}</th> <!-- Ajuste para acessar os relacionamentos -->
                <th class="py-2">{{ $item->screening->start_time }}</th> <!-- Ajuste para acessar os relacionamentos -->
                <th class="py-2">
                    <img src="{{ $item->qrcode_url }}" alt="QR Code">
                </th>
                <th class="py-2">
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remover</button>
                    </form>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Formulário para limpar todo o carrinho -->
    <form action="{{ route('cart.destroy') }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-4">Limpar Carrinho</button>
    </form>
    @endif
</div>
@endsection
