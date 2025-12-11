@props(['label' => null, 'id'])

<div>
    @if($label)
        <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $id }}">{{ $label }}</label>
    @endif
    <select 
        {{ $attributes->merge(['class' => 'block w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 rounded leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent']) }}
        id="{{ $id }}"
    >
        {{ $slot }}
    </select>
</div>
