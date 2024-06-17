@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold">Screenings</h2>
            <a href="{{ route('screenings.create') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Add New Screening</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-purple-100 border border-purple-200">
                <thead>
                    <tr class="bg-purple-300">
                        <th class="py-2 px-4 border-b border-purple-200">
                            <a href="{{ route('screenings.index', array_merge(request()->query(), ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                ID
                                @if(request('sort') === 'id')
                                    @if(request('direction') === 'asc')
                                        ↑
                                    @else
                                        ↓
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="py-2 px-4 border-b border-purple-200">
                            <a href="{{ route('screenings.index', array_merge(request()->query(), ['sort' => 'movie_id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                Movie
                                @if(request('sort') === 'movie_id')
                                    @if(request('direction') === 'asc')
                                        ↑
                                    @else
                                        ↓
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="py-2 px-4 border-b border-purple-200">
                            <a href="{{ route('screenings.index', array_merge(request()->query(), ['sort' => 'theater_id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                Theater
                                @if(request('sort') === 'theater_id')
                                    @if(request('direction') === 'asc')
                                        ↑
                                    @else
                                        ↓
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="py-2 px-4 border-b border-purple-200">
                            <a href="{{ route('screenings.index', array_merge(request()->query(), ['sort' => 'date', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                Date
                                @if(request('sort') === 'date')
                                    @if(request('direction') === 'asc')
                                        ↑
                                    @else
                                        ↓
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="py-2 px-4 border-b border-purple-200">
                            <a href="{{ route('screenings.index', array_merge(request()->query(), ['sort' => 'start_time', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                Screening Time
                                @if(request('sort') === 'start_time')
                                    @if(request('direction') === 'asc')
                                        ↑
                                    @else
                                        ↓
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="py-2 px-4 border-b border-purple-200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($screenings as $screening)
                        <tr class="hover:bg-purple-200">
                            <td class="py-2 px-4 border-b border-purple-200">{{ $screening->id }}</td>
                            <td class="py-2 px-4 border-b border-purple-200">{{ $screening->movie->title }}</td>
                            <td class="py-2 px-4 border-b border-purple-200">{{ $screening->theater->name }}</td>
                            <td class="py-2 px-4 border-b border-purple-200">{{ $screening->date }}</td>
                            <td class="py-2 px-4 border-b border-purple-200">{{ $screening->start_time }}</td>
                            <td class="py-2 px-4 border-b border-purple-200">
                                <form method="POST" action="{{ route('screenings.destroy', $screening->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $screenings->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
