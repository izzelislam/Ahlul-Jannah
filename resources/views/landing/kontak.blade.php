@extends('layouts.landing')

@section('title', ($page->content['hero']['title'] ?? 'Kontak') . ' - Pondok Pesantren Tahfidz Ahlul Jannah')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 pt-32 pb-20 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-pattern opacity-10"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-primary-900/50"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-primary-200 font-semibold mb-3 tracking-wide uppercase text-sm">{{ $page->content['hero']['subtitle'] ?? 'Kontak Kami' }}</p>
                <h1 class="text-4xl lg:text-5xl font-bold mb-6">{{ $page->content['hero']['title'] ?? 'Hubungi Kami' }}</h1>
                <p class="text-primary-100 text-lg leading-relaxed">{{ $page->content['hero']['description'] ?? '' }}</p>
            </div>
        </div>
    </section>

    <!-- Contact Info Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                @if(isset($page->content['contact_info']))
                    @foreach($page->content['contact_info'] as $key => $info)
                        <div class="bg-gradient-to-br from-white to-slate-50 p-6 rounded-xl border border-slate-200 hover:border-primary-300 hover:shadow-lg transition-all duration-300 group">
                            <div class="w-14 h-14 bg-primary-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary-600 transition-colors">
                                <i class="fas {{ $info['icon'] ?? 'fa-info' }} text-2xl text-primary-600 group-hover:text-white transition-colors"></i>
                            </div>
                            <h3 class="text-sm font-semibold text-slate-500 mb-2">{{ $info['label'] ?? '' }}</h3>
                            @if($key === 'whatsapp' && isset($info['link']))
                                <a href="{{ $info['link'] }}" target="_blank" class="text-slate-900 font-medium hover:text-primary-600 transition-colors">
                                    {{ $info['value'] ?? '' }}
                                </a>
                            @elseif($key === 'email')
                                <a href="mailto:{{ $info['value'] }}" class="text-slate-900 font-medium hover:text-primary-600 transition-colors">
                                    {{ $info['value'] ?? '' }}
                                </a>
                            @elseif($key === 'telepon')
                                <a href="tel:{{ str_replace([' ', '-', '+'], '', $info['value']) }}" class="text-slate-900 font-medium hover:text-primary-600 transition-colors">
                                    {{ $info['value'] ?? '' }}
                                </a>
                            @else
                                <p class="text-slate-900 font-medium">{{ $info['value'] ?? '' }}</p>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-8 rounded-2xl border-2 border-slate-200 shadow-lg">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6">Kirim Pesan</h2>
                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                                    <input type="text" name="name" required class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Nama Anda">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                                    <input type="email" name="email" required class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="email@example.com">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nomor Telepon</label>
                                <input type="tel" name="phone" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="+62 812-3456-7890">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Subjek</label>
                                <input type="text" name="subject" required class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Subjek pesan">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Pesan</label>
                                <textarea name="message" rows="5" required class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Tulis pesan Anda di sini..."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="space-y-6">
                    <!-- Jam Operasional -->
                    @if(isset($page->content['jam_operasional']))
                    <div class="bg-gradient-to-br from-primary-50 to-blue-50 p-6 rounded-xl border border-primary-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center">
                            <i class="fas fa-clock text-primary-600 mr-2"></i>
                            {{ $page->content['jam_operasional']['title'] ?? 'Jam Operasional' }}
                        </h3>
                        <div class="space-y-3">
                            @if(isset($page->content['jam_operasional']['items']))
                                @foreach($page->content['jam_operasional']['items'] as $jadwal)
                                    <div class="flex justify-between items-center py-2 border-b border-primary-100 last:border-0">
                                        <span class="text-slate-700 font-medium">{{ $jadwal['hari'] ?? '' }}</span>
                                        <span class="text-slate-600 text-sm">{{ $jadwal['jam'] ?? '' }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Social Media -->
                    @if(isset($page->content['social_media']))
                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">
                            {{ $page->content['social_media']['title'] ?? 'Media Sosial' }}
                        </h3>
                        <div class="space-y-3">
                            @if(isset($page->content['social_media']['items']))
                                @foreach($page->content['social_media']['items'] as $social)
                                    <a href="{{ $social['url'] ?? '#' }}" target="_blank" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors group">
                                        <div class="w-10 h-10 {{ $social['color'] ?? 'bg-gray-600' }} rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                            <i class="{{ $social['icon'] ?? 'fab fa-link' }} text-white"></i>
                                        </div>
                                        <span class="text-slate-700 font-medium group-hover:text-primary-600 transition-colors">{{ $social['name'] ?? '' }}</span>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Maps Section -->
    @if(isset($page->content['maps']['embed_url']))
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Lokasi Kami</h2>
                <p class="text-slate-600">Temukan kami di peta</p>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-xl border-4 border-white">
                <iframe 
                    src="{{ $page->content['maps']['embed_url'] }}" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full">
                </iframe>
            </div>
        </div>
    </section>
    @endif
@endsection
