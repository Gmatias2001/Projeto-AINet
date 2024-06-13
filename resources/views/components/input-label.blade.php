@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-2xl text-indigo-400']) }}>
    {{ $value ?? $slot }}
</label>
