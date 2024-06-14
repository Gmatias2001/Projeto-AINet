<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out']) }}>
    {{ $slot }}
</button>
