@extends('layouts.app')

@section('content')
<body>

    <h2>Edit Movie "{{ $movie->title }}"</h2>

    <form method="POST" action="{{ route('movies.update', ['movie' => $movie]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mt-6 space-y-4">
            @include('movies.shared.fields', ['mode' => 'edit'])
        </div>
    </form>

    <div class="flex mt-6">
        <button element="submit" type="dark" text="Save" class="uppercase"
            href="{{ url()->full() }}">Submit</button>
        <button element="a" type="light" text="Cancel" class="uppercase ms-4"
            href="{{ url()->full() }}">Cancel</button>
    </div>

</body>
@endsection
