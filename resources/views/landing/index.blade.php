@extends('layouts.landing')

@section('title', 'Beranda - Pondok Informatika Al-Madinah')

@section('content')
    <!-- Hero Section -->
    <section id="home" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="blob bg-primary-300 w-96 h-96 rounded-full top-0 left-0 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="blob bg-blue-200 w-96 h-96 rounded-full bottom-0 right-0 translate-x-1/3 translate-y-1/3"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-50 border border-primary-100 text-primary-700 text-sm font-semibold">
                        <span class="relative flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-primary-500"></span>
                        </span>
                        {{ $page->content['hero']['badge'] ?? 'Penerimaan Santri Baru' }}
                    </div>
                    <h1 class="text-4xl lg:text-6xl font-bold text-slate-900 leading-tight">
                        {{ $page->content['hero']['title_1'] ?? 'Pesantren Tahfidz' }}<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-blue-600">{{ $page->content['hero']['title_2'] ?? 'Ahlul Jannah Takalar' }}</span>
                    </h1>
                    <p class="text-lg text-slate-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        {{ $page->content['hero']['description'] ?? '' }}
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="{{ route($page->content['hero']['button1_url'] ?? 'landing.pendaftaran') }}" class="w-full sm:w-auto px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-xl shadow-primary-600/20 transition transform hover:-translate-y-1 text-center">
                            {{ $page->content['hero']['button1_text'] ?? 'Daftar Sekarang' }}
                        </a>
                        <a href="{{ $page->content['hero']['button2_url'] ?? '#video' }}" class="w-full sm:w-auto px-8 py-4 bg-white hover:bg-slate-50 text-slate-700 font-bold rounded-xl border border-slate-200 shadow-sm transition flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                            </svg>
                            {{ $page->content['hero']['button2_text'] ?? 'Tonton Video' }}
                        </a>
                    </div>
                    <div class="pt-8 flex items-center justify-center lg:justify-start gap-8 text-slate-500">
                        @if(isset($page->content['hero']['features']) && is_array($page->content['hero']['features']))
                            @foreach($page->content['hero']['features'] as $feature)
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span>{{ $feature }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-primary-600 to-blue-600 rounded-[2rem] rotate-3 opacity-20 blur-lg"></div>
                    <img src="{{ $page->content['hero']['image'] ?? 'https://source.unsplash.com/random/800x600?mosque' }}" alt="Hero Image" class="relative rounded-[2rem] shadow-2xl border-4 border-white w-full object-cover h-[500px]">
                    
                    <!-- Floating Card -->
                    <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-xl border border-slate-100 max-w-xs hidden md:block">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500">Status Pendaftaran</p>
                                <p class="font-bold text-slate-800">Gelombang 1 Dibuka</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="relative order-2 md:order-1">
                    <div class="grid grid-cols-2 gap-4">
                        <img src="{{ $page->content['about']['image_1'] ?? 'https://source.unsplash.com/random/400x300?student' }}" class="rounded-2xl shadow-lg mt-8" alt="Activity">
                        <img src="{{ $page->content['about']['image_2'] ?? 'https://source.unsplash.com/random/400x300?school' }}" class="rounded-2xl shadow-lg" alt="Activity">
                    </div>
                    <div class="absolute -z-10 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-primary-50/50 rounded-full blur-3xl"></div>
                </div>
                <div class="order-1 md:order-2">
                    <h4 class="text-primary-600 font-bold uppercase tracking-wider mb-2">{{ $page->content['about']['subtitle'] ?? 'Tentang Kami' }}</h4>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">{{ $page->content['about']['title'] ?? '' }}</h2>
                    <p class="text-slate-600 mb-6 leading-relaxed">
                        {{ $page->content['about']['description'] ?? '' }}
                    </p>
                    <ul class="space-y-4">
                        @if(isset($page->content['about']['features']) && is_array($page->content['about']['features']))
                            @foreach($page->content['about']['features'] as $feature)
                                <li class="flex items-start gap-3">
                                    <div class="mt-1 w-6 h-6 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-slate-800">{{ $feature['title'] ?? '' }}</h5>
                                        <p class="text-sm text-slate-600">{{ $feature['description'] ?? '' }}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section id="programs" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h4 class="text-primary-600 font-bold uppercase tracking-wider mb-2">Jenjang Pendidikan</h4>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Pendidikan Berkarakter Sejak Dini</h2>
                <p class="text-slate-600">Kami menyediakan layanan pendidikan lengkap untuk Putra dan Putri dari usia dini hingga menengah atas.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($programs as $program)
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition duration-300 border border-slate-100 group flex flex-col h-full">
                        <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center text-primary-600 mb-6 group-hover:scale-110 transition duration-300 flex-shrink-0">
                            @if($program->image)
                                <img src="{{ Storage::url($program->image) }}" alt="{{ $program->title }}" class="w-full h-full object-cover rounded-xl">
                            @else
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $program->title }}</h3>
                        <p class="text-slate-600 mb-4 text-sm flex-grow">{{ Str::limit($program->description ?? $program->subtitle, 100) }}</p>
                        <a href="{{ route('landing.program') }}" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 mt-auto">
                            Detail Program <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10">
                        <p class="text-slate-500">Belum ada program yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section id="video" class="py-20 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80')] bg-cover bg-center opacity-10"></div>
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-8">{{ $page->content['video']['title'] ?? 'Lihat Keseharian Kami' }}</h2>
            <div class="relative aspect-video rounded-2xl overflow-hidden shadow-2xl border border-slate-700 bg-slate-800 group cursor-pointer">
                <iframe class="w-full h-full" src="{{ $page->content['video']['youtube_url'] ?? 'https://www.youtube.com/embed/jfKfPfyJRdk' }}" title="YouTube video" allowfullscreen></iframe>
            </div>
            <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Stats similar to welcome.blade.php -->
                 @if(isset($page->content['video']['stats']) && is_array($page->content['video']['stats']))
                    @foreach($page->content['video']['stats'] as $stat)
                        <div class="text-center">
                            <h3 class="text-4xl font-bold text-primary-400">{{ $stat['count'] ?? '0' }}</h3>
                            <p class="text-slate-400 text-sm mt-1">{{ $stat['label'] ?? '' }}</p>
                        </div>
                    @endforeach
                @else
                    <div class="text-center">
                        <h3 class="text-4xl font-bold text-primary-400">100+</h3>
                        <p class="text-slate-400 text-sm mt-1">Santri Aktif</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Gallery / News -->
    <section id="gallery" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="flex justify-between items-end mb-12">
                <div>
                    <h4 class="text-primary-600 font-bold uppercase tracking-wider mb-2">Galeri & Berita</h4>
                    <h2 class="text-3xl font-bold text-slate-900">Dokumentasi Kegiatan</h2>
                </div>
                <a href="{{ route('landing.galeri') }}" class="hidden md:inline-flex items-center text-primary-600 font-semibold hover:text-primary-700">
                    Lihat Semua <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 auto-rows-[200px]">
                @forelse($galleries as $index => $item)
                    <!-- Determine if item should span 2 rows/cols for visual variety on homepage too -->
                    @php
                        $classes = 'relative group overflow-hidden rounded-2xl';
                        if ($index == 0) {
                             $classes .= ' md:col-span-2 md:row-span-2';
                        }
                    @endphp

                     <div class="{{ $classes }}">
                        @if($item->type == 'video')
                             <video src="{{ Storage::url($item->file_path) }}" class="w-full h-full object-cover" muted loop onmouseover="this.play()" onmouseout="this.pause()"></video>
                             <div class="absolute inset-0 flex items-center justify-center pointer-events-none group-hover:opacity-0 transition">
                                <i class="fas fa-play-circle text-white text-4xl opacity-80"></i>
                            </div>
                        @else
                            <img src="{{ Storage::url($item->file_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        @endif
                         <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                            <p class="text-white text-sm font-semibold">{{ $item->title }}</p>
                        </div>
                    </div>
                @empty
                    <!-- Static fallback if no dynamic data, to keep it looking good as per request "kaya semula" -->
                    <div class="md:col-span-2 md:row-span-2 relative group overflow-hidden rounded-2xl">
                        <img src="https://images.unsplash.com/photo-1571260899304-425eee4c7efc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Gallery" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    </div>
                    <div class="relative group overflow-hidden rounded-2xl">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Gallery" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    </div>
                    <div class="relative group overflow-hidden rounded-2xl">
                        <img src="https://images.unsplash.com/photo-1531545514256-b1400bc00f31?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Gallery" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    </div>
                    <div class="md:col-span-2 relative group overflow-hidden rounded-2xl">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Gallery" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Instagram Section -->
    <section id="instagram" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h4 class="text-primary-600 font-bold uppercase tracking-wider mb-2">{{ $page->content['instagram']['subtitle'] ?? 'Social Media' }}</h4>
                <h2 class="text-3xl font-bold text-slate-900">{{ $page->content['instagram']['title'] ?? 'Instagram Pondok Informatika' }}</h2>
                <p class="text-slate-600 mt-4">{{ $page->content['instagram']['description'] ?? '' }}</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- IG Items (Static for now as API integration is complex) -->
                <a href="#" class="group relative block aspect-square overflow-hidden rounded-xl">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Instagram 1" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                </a>
                 <a href="#" class="group relative block aspect-square overflow-hidden rounded-xl">
                    <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Instagram 2" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                </a>
                 <a href="#" class="group relative block aspect-square overflow-hidden rounded-xl">
                    <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Instagram 3" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                </a>
                 <a href="#" class="group relative block aspect-square overflow-hidden rounded-xl">
                    <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Instagram 4" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                </a>
            </div>
             <div class="mt-8 text-center">
                <a href="{{ $page->content['instagram']['link_url'] ?? '#' }}" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700">
                    {{ $page->content['instagram']['link_text'] ?? 'Lihat Lebih Banyak di Instagram' }} <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section id="register" class="py-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl p-10 md:p-16 text-center text-white shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20">
                    <div class="absolute -top-24 -left-24 w-64 h-64 rounded-full bg-white blur-3xl"></div>
                    <div class="absolute top-1/2 right-0 w-48 h-48 rounded-full bg-blue-400 blur-3xl"></div>
                </div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-bold mb-6">{{ $page->content['cta']['title'] ?? 'Siap Menjadi Programmer Hafidz?' }}</h2>
                    <p class="text-primary-100 text-lg mb-8 max-w-2xl mx-auto">
                        {{ $page->content['cta']['description'] ?? '' }}
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route($page->content['cta']['button1_url'] ?? 'landing.pendaftaran') }}" class="px-8 py-4 bg-white text-primary-700 font-bold rounded-xl shadow-lg hover:bg-slate-50 transition transform hover:-translate-y-1">
                            {{ $page->content['cta']['button1_text'] ?? 'Daftar Sekarang' }}
                        </a>
                        <a href="{{ $page->content['cta']['button2_url'] ?? '#' }}" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-xl hover:bg-white/10 transition">
                            {{ $page->content['cta']['button2_text'] ?? 'Konsultasi via WA' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
