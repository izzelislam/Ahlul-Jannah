@props([
    'title',
    'description',
    'icon' => 'fas fa-layer-group',
    'createRoute' => null,
    'createLabel' => 'Tambah Baru',
    'gradient' => 'from-blue-600 to-indigo-700'
])

<div class="mb-8 flex flex-col sm:flex-row justify-between items-center bg-gradient-to-r {{ $gradient }} p-6 rounded-2xl shadow-lg relative overflow-hidden">
    <div class="absolute right-0 top-0 opacity-10 transform translate-x-10 -translate-y-10">
        <i class="{{ $icon }} text-9xl text-white"></i>
    </div>
    <div class="relative z-10 text-white mb-4 sm:mb-0">
        <h1 class="text-3xl font-bold">{{ $title }}</h1>
        <p class="text-blue-100 text-sm mt-1">{{ $description }}</p>
    </div>
    
    @if($createRoute)
    <a href="{{ $createRoute }}" class="relative z-10">
        <x-ui.button class="bg-amber-400 text-amber-900 hover:bg-amber-500 border-none shadow-md font-bold px-6 py-3 transition-transform transform hover:-translate-y-1">
            <i class="fas fa-plus-circle mr-2"></i> {{ $createLabel }}
        </x-ui.button>
    </a>
    @endif

    @if(isset($backRoute))
    <a href="{{ $backRoute }}" class="relative z-10">
        <x-ui.button variant="secondary" class="bg-white/10 text-white hover:bg-white/20 border-white/20 backdrop-blur-sm shadow-md font-bold px-6 py-3 transition-transform transform hover:-translate-y-1">
            <i class="fas fa-arrow-left mr-2"></i> {{ $backLabel ?? 'Kembali' }}
        </x-ui.button>
    </a>
    @endif
</div>
