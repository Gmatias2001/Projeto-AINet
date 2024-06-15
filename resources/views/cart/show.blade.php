@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-5xl font-bold mb-8">Detalhes do Bilhete</h1>

    <div class="flex justify-center">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Filme</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Assento</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Data da Sessão</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Hora da Sessão</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Remover</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->screening->movie->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->seat->row }}, {{ $ticket->seat->seat_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->screening->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->screening->date->start_time }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('cart.remove', ['ticket' => $ticket->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
