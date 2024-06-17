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


    </form>
</div>
