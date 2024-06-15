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
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Filme</th>
                    <th class="py-2">Data</th>
                    <th class="py-2">Hora</th>
                    <th class="py-2">QR Code</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    <tr>
                        <td class="py-2">{{ $item->movie_name }}</td>
                        <td class="py-2">{{ $item->session_date }}</td>
                        <td class="py-2">{{ $item->session_time }}</td>
                        <td class="py-2">
                            <img src="{{ $item->qr_code_url }}" alt="QR Code">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
