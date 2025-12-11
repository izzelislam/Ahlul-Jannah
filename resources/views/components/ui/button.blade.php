@props(['variant' => 'primary', 'type' => 'button'])

@php
    $variants = [
        'primary' => 'bg-blue-600 hover:bg-blue-700 text-white',
        'secondary' => 'bg-gray-200 hover:bg-gray-300 text-gray-800',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white',
        'success' => 'bg-green-600 hover:bg-green-700 text-white',
        'indigo' => 'bg-indigo-600 hover:bg-indigo-700 text-white',
    ];
    
    $classes = $variants[$variant] ?? $variants['primary'];
@endphp

<button 
    type="{{ $type }}" 
    {{ $attributes->merge(['class' => "$classes font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150"]) }}
>
    {{ $slot }}
</button>
