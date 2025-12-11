@props(['color' => 'green'])

@php
    $colors = [
        'green' => [
            'text' => 'text-green-900',
            'bg' => 'bg-green-200',
        ],
        'red' => [
            'text' => 'text-red-900',
            'bg' => 'bg-red-200',
        ],
        'orange' => [
            'text' => 'text-orange-900',
            'bg' => 'bg-orange-200',
        ],
        'blue' => [
            'text' => 'text-blue-900',
            'bg' => 'bg-blue-200',
        ],
    ];

    $style = $colors[$color] ?? $colors['green'];
@endphp

<span class="relative inline-block px-3 py-1 font-semibold {{ $style['text'] }} leading-tight">
    <span aria-hidden class="absolute inset-0 {{ $style['bg'] }} opacity-50 rounded-full"></span>
    <span class="relative">{{ $slot }}</span>
</span>
