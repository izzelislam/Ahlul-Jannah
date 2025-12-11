@extends('layouts.landing')

@section('title', 'Galeri Kegiatan - Pondok Informatika Al-Madinah')

@push('styles')
    <!-- Lightbox2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" />
    <style>
        /* Custom override for Lightbox to center and enlarge */
        .lightboxOverlay {
            background-color: rgba(0, 0, 0, 0.9) !important;
        }
        .lightbox {
            /* Force fixed center */
            position: fixed !important;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%);
            width: auto !important;
            height: auto !important;
        }
        .lb-outerContainer {
            background-color: transparent !important;
            width: auto !important;
            height: auto !important;
        }
        .lb-image {
            /* Ensure image allows growing but respects viewport */
            max-width: 90vw !important;
            max-height: 85vh !important;
            border: 4px solid white !important;
            border-radius: 8px;
        }
        .lb-dataContainer {
            width: 100% !important;
            padding-top: 10px;
        }
        .lb-data .lb-caption {
            font-size: 1.25rem;
            font-weight: 700;
            line-height: 1.4;
            color: #e2e8f0;
        }
        .lb-data .lb-number {
            font-size: 0.9rem;
            color: #94a3b8;
        }
        /* Fix close button position if needed */
        .lb-close {
            margin-right: -20px;
        }
    </style>
@endpush

@section('content')
    <!-- Header Hero -->
    <section class="relative pt-32 pb-32 bg-slate-900 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80')] bg-cover bg-center opacity-20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6 mt-[100px]">Galeri Kegiatan</h1>
            <p class="text-slate-300 text-lg max-w-2xl mx-auto">
                Merekam jejak langkah dan momen berharga para santri dalam menuntut ilmu dan menghafal Al-Qur'an.
            </p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="relative bg-white pb-20 pt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt- relative z-20">
            <!-- Filter Tabs (Visual Only) -->
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button class="px-6 py-3 bg-primary-600 text-white rounded-full text-sm font-bold shadow-lg shadow-primary-500/30 ring-2 ring-primary-600 ring-offset-2 transition transform hover:scale-105">Semua</button>
                <button class="px-6 py-3 bg-white text-slate-600 hover:text-primary-600 rounded-full text-sm font-bold shadow-md hover:shadow-lg transition transform hover:scale-105">Kajian & Tahfidz</button>
                <button class="px-6 py-3 bg-white text-slate-600 hover:text-primary-600 rounded-full text-sm font-bold shadow-md hover:shadow-lg transition transform hover:scale-105">IT Bootcamp</button>
                <button class="px-6 py-3 bg-white text-slate-600 hover:text-primary-600 rounded-full text-sm font-bold shadow-md hover:shadow-lg transition transform hover:scale-105">Ekstrakurikuler</button>
            </div>

            <!-- Masonry Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 auto-rows-[200px]">
                @forelse($galleries as $index => $item)
                    @php
                        // Grid logic
                        $classes = 'relative group overflow-hidden rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:z-10 hover:scale-[1.02] bg-slate-100';
                        if ($index % 5 == 0) {
                             $classes .= ' md:col-span-2 md:row-span-2';
                        } elseif ($index % 9 == 0) {
                             $classes .= ' md:col-span-2';
                        }
                    @endphp

                    <div class="{{ $classes }}">
                        @if($item->type == 'video')
                            <!-- Video Item: Hover to Play, No Lightbox for Video (Simplification) -->
                             <video src="{{ Storage::url($item->file_path) }}" class="w-full h-full object-cover" muted loop onmouseover="this.play()" onmouseout="this.pause()"></video>
                             <div class="absolute inset-0 flex items-center justify-center pointer-events-none group-hover:opacity-0 transition">
                                <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-full flex items-center justify-center border border-white/50">
                                     <i class="fas fa-play text-white ml-1"></i>
                                </div>
                            </div>
                            <div class="absolute bottom-4 left-4 pointer-events-none">
                                <span class="px-2 py-1 bg-black/50 text-white text-xs rounded font-bold">VIDEO</span>
                            </div>
                        @else
                            <!-- Image Item: Lightbox2 Integration -->
                            <a href="{{ Storage::url($item->file_path) }}" data-lightbox="gallery" data-title="{{ $item->title }}" class="block w-full h-full">
                                <img src="{{ Storage::url($item->file_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6 pointer-events-none">
                                    <span class="text-xs text-primary-300 font-bold tracking-wider uppercase mb-1">Dokumentasi</span>
                                    <h3 class="text-white font-bold leading-tight">{{ $item->title }}</h3>
                                </div>
                            </a>
                        @endif
                    </div>
                @empty
                    <!-- Fallback Static Items for demo -->
                    @php 
                        $demoImages = [
                            ['src' => 'https://images.unsplash.com/photo-1571260899304-425eee4c7efc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Kegiatan Belajar'],
                            ['src' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Suasana Kelas'],
                            ['src' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Diskusi Kelompok'],
                            ['src' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Coding Session'],
                        ]; 
                    @endphp
                     
                    @foreach($demoImages as $idx => $demo)
                         <div class="relative group overflow-hidden rounded-2xl shadow-md min-h-[200px]">
                            <a href="{{ $demo['src'] }}" data-lightbox="gallery" data-title="{{ $demo['title'] }}" class="block w-full h-full">
                                <img src="{{ $demo['src'] }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4 pointer-events-none">
                                    <p class="text-white font-bold">{{ $demo['title'] }}</p>
                                </div>
                            </a>
                         </div>
                    @endforeach
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center">
                {{ $galleries->links() }}
            </div>
        </div>
    </section>

    @push('scripts')
        <!-- jQuery (Required for Lightbox2) -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <!-- Lightbox2 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
        <script>
            lightbox.option({
              'resizeDuration': 200,
              'wrapAround': true,
              'albumLabel': "Foto %1 dari %2",
              'positionFromTop': 0, // Let CSS handle vertical centering
              'fitImagesInViewport': true,
              'imageFadeDuration': 300
            });
        </script>
    @endpush
@endsection
