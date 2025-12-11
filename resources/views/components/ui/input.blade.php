@props(['label' => null, 'id', 'type' => 'text', 'placeholder' => ''])

<div>
    @if($label)
        <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $id }}">{{ $label }}</label>
    @endif
    <input 
        {{ $attributes->merge(['class' => 'shadow-sm appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent']) }}
        id="{{ $id }}" 
        type="{{ $type }}" 
        placeholder="{{ $placeholder }}"
    >
</div>
