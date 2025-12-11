@props(['title', 'value', 'icon', 'color' => 'blue'])

@php
    $colors = [
        'blue' => [
            'border' => 'border-blue-500',
            'bg_icon' => 'bg-blue-100',
            'text_icon' => 'text-blue-500',
        ],
        'green' => [
            'border' => 'border-green-500',
            'bg_icon' => 'bg-green-100',
            'text_icon' => 'text-green-500',
        ],
        'yellow' => [
            'border' => 'border-yellow-500',
            'bg_icon' => 'bg-yellow-100',
            'text_icon' => 'text-yellow-500',
        ],
        'red' => [
            'border' => 'border-red-500',
            'bg_icon' => 'bg-red-100',
            'text_icon' => 'text-red-500',
        ],
    ];

    $style = $colors[$color] ?? $colors['blue'];
@endphp

<div class="bg-white rounded-lg shadow p-5 flex items-center border-l-4 {{ $style['border'] }}">
    <div class="p-3 rounded-full {{ $style['bg_icon'] }} {{ $style['text_icon'] }} mr-4">
        <i class="{{ $icon }} text-xl"></i>
    </div>
    <div>
        <p class="text-gray-500 text-sm font-medium uppercase">{{ $title }}</p>
        <p class="text-2xl font-bold text-gray-800">{{ $value }}</p>
    </div>
</div>
