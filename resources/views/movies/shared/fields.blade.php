@php
    $mode = $mode ?? 'edit';
    $readonly = $mode == 'show';
@endphp
<div class="flex flex-wrap space-x-8">
    <form method="POST" action="/movieslist" enctype="multipart/form-data">
        @csrf
        <div class="grow mt-6 space-y-4">
            <div>
                <label for="title">Title</label>
                <input name="title" label="Title" width="md" :readonly="$readonly" || $mode=='edit'
                    value="{{ old('title', $movie->title) }}" />
            </div>

            <div>
                <label for="genre_code">Genre Code</label>
                <select name="genre_code" label="Genre Code" :readonly="$readonly"
                    value="{{ old('genre_code', $movie->genre_code) }}">
                    <option>ACTION</option>
                    <option>ADVENTURE</option>
                    <option>ANIMATION</option>
                    <option>BIOGRAPHY</option>
                    <option>COMEDY</option>
                    <option>COMEDY-ACTION</option>
                    <option>COMEDY-ROMANCE</option>
                    <option>CULT</option>
                    <option>DRAMA</option>
                    <option>FAMILY</option>
                    <option>FANTASY</option>
                    <option>HISTORY</option>
                    <option>HORROR</option>
                    <option>MYSTERY</option>
                    <option>MUSICAL</option>
                    <option>ROMANCE</option>
                    <option>SCI-FI</option>
                    <option>SUPERHERO</option>
                    <option>THRILLER</option>
                    <option>WAR</option>
                    <option>WESTERN</option>
                </select>
            </div>

            <div>
                <label for="year">Year</label>
                <input name="year" label="Year" :readonly="$readonly" value="{{ old('year', $movie->year) }}" />
            </div>

            <div>
                <label for="trailer_url">Trailer URL</label>
                <input name="trailer_url" label="Trailer URL" :readonly="$readonly"
                    value="{{ old('trailer_url', $movie->trailer_url) }}" />
            </div>

            <div>
                <label for="synopsis">Synopsis</label>
                <input name="synopsis" label="Synopsis" :readonly="$readonly"
                    value="{{ old('synopsis', $movie->synopsis) }}" />
            </div>

            <div>
                <label for="poster_filename">Poster</label>
                <input type="file" name="poster_filename" id="poster_filename">
            </div>

            <div class="pb-6">
                <img name="poster" label="Poster" width="md" :readonly="$readonly" deleteTitle="Delete Image"
                    :deleteAllow="$mode == 'edit' && $movie - > imageExists" deleteForm="form_to_delete_image"
                    :imageUrl="$movie - > poster_filename" />
            </div>

            <div class=" flex-col space-y-4 items-stretch mt-4">
                <div>
                    <div class="flex flex-row items-center">
                        <input id="id_{{ $movie->title }}" name="{{ $title }}" type="file"
                            accept="image/png, image/jpeg"
                            onchange="document.getElementById('id_{{ $title }}_selected_file').innerHTML= document.getElementById('id_{{ $title }}').files[0].title ?? ''"
                            class="hidden" />
                        <label for="id_{{ $title }}"
                            class="min-w-32
                            px-4 py-2 mr-2 inline-block border border-transparent
                            rounded-md
                            font-medium text-sm tracking-widest
                            focus:outline-none focus:ring-2
                            focus:ring-indigo-500 dark:focus:ring-indigo-400
                            focus:ring-offset-2 transition ease-in-out duration-150
                            text-white dark:text-gray-900
                            bg-gray-800 dark:bg-gray-200
                            hover:bg-gray-900 dark:hover:bg-gray-100
                            focus:bg-gray-900 dark:focus:bg-gray-100
                            active:bg-gray-950 dark:active:bg-gray-50
                            cursor-pointer">Choose file</label>
                        <label id="id_{{ $title }}_selected_file"
                            class="text-sm text-slate-500 truncate"></label>
                    </div>
                    @error($name)
                        <div class="text-sm text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @if ($deleteAllow)
                    <div>
                        <button element="submit" :text="$deleteTitle" type="danger" form="{{ $deleteForm }}">Submit</button>
                    </div>
                @endif
            </div>
    </form>
</div>
