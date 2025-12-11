@extends('layouts.landing')

@section('title', ($page->content['hero']['title'] ?? 'Profil') . ' - Pondok Pesantren Tahfidz Ahlul Jannah')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 pt-32 pb-20 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('{{ $page->content['hero']['image'] ?? '' }}')] bg-cover bg-center opacity-10"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-primary-900/50"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-primary-200 font-semibold mb-3 tracking-wide uppercase text-sm">{{ $page->content['hero']['subtitle'] ?? 'Tentang Kami' }}</p>
                <h1 class="text-4xl lg:text-5xl font-bold mb-6">{{ $page->content['hero']['title'] ?? 'Profil Pondok Pesantren' }}</h1>
                <p class="text-primary-100 text-lg leading-relaxed">{{ $page->content['hero']['description'] ?? '' }}</p>
            </div>
        </div>
    </section>

    <!-- Sejarah Section -->
    @if(isset($page->content['sejarah']))
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">{{ $page->content['sejarah']['title'] ?? 'Sejarah Singkat' }}</h2>
            </div>
            
            <div class="bg-gradient-to-br from-primary-50 to-blue-50 p-8 lg:p-12 rounded-2xl border border-primary-100 shadow-sm">
                <div class="flex items-start gap-6 mb-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-primary-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                            {{ $page->content['sejarah']['year_founded'] ?? '2015' }}
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-slate-700 leading-relaxed text-lg mb-4">{{ $page->content['sejarah']['content'] ?? '' }}</p>
                        @if(isset($page->content['sejarah']['founder']))
                        <div class="flex items-center gap-3 text-sm text-slate-600">
                            <i class="fas fa-user-tie text-primary-600"></i>
                            <span><strong>Pendiri:</strong> {{ $page->content['sejarah']['founder'] }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Visi Misi Section -->
    @if(isset($page->content['visi_misi']))
    <section class="py-20 bg-slate-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">Visi & Misi</h2>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Visi -->
                <div class="bg-gradient-to-br from-primary-600 to-primary-700 p-8 lg:p-10 rounded-2xl text-white shadow-xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-eye text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Visi</h3>
                    </div>
                    <p class="text-primary-50 leading-relaxed text-lg">{{ $page->content['visi_misi']['visi'] ?? '' }}</p>
                </div>
                
                <!-- Misi -->
                <div class="bg-white p-8 lg:p-10 rounded-2xl border-2 border-primary-200 shadow-lg">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bullseye text-primary-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900">Misi</h3>
                    </div>
                    <ul class="space-y-3">
                        @if(isset($page->content['visi_misi']['misi']) && is_array($page->content['visi_misi']['misi']))
                            @foreach($page->content['visi_misi']['misi'] as $misi)
                            <li class="flex items-start gap-3 text-slate-700">
                                <i class="fas fa-check-circle text-primary-600 mt-1 flex-shrink-0"></i>
                                <span>{{ $misi }}</span>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Statistik Section -->
    @if(isset($page->content['statistik']))
    <section class="py-16 bg-primary-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($page->content['statistik'] as $stat)
                <div class="text-center">
                    <div class="text-4xl lg:text-5xl font-bold text-white mb-2">{{ $stat['count'] ?? '0' }}</div>
                    <div class="text-primary-200 font-medium">{{ $stat['label'] ?? '' }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Fasilitas Section -->
    @if(isset($page->content['fasilitas']))
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">{{ $page->content['fasilitas']['title'] ?? 'Fasilitas' }}</h2>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(isset($page->content['fasilitas']['items']) && is_array($page->content['fasilitas']['items']))
                    @foreach($page->content['fasilitas']['items'] as $fasilitas)
                    <div class="bg-gradient-to-br from-white to-slate-50 p-6 rounded-xl border border-slate-200 hover:border-primary-300 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-14 h-14 bg-primary-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary-600 transition-colors">
                            <i class="fas {{ $fasilitas['icon'] ?? 'fa-check' }} text-2xl text-primary-600 group-hover:text-white transition-colors"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $fasilitas['name'] ?? '' }}</h3>
                        <p class="text-slate-600">{{ $fasilitas['description'] ?? '' }}</p>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- Prestasi Section -->
    @if(isset($page->content['prestasi']))
    <section class="py-20 bg-gradient-to-br from-slate-50 to-blue-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">{{ $page->content['prestasi']['title'] ?? 'Prestasi' }}</h2>
            </div>
            
            <div class="bg-white p-8 lg:p-10 rounded-2xl shadow-lg border border-slate-200">
                <ul class="space-y-4">
                    @if(isset($page->content['prestasi']['items']) && is_array($page->content['prestasi']['items']))
                        @foreach($page->content['prestasi']['items'] as $index => $prestasi)
                        <li class="flex items-start gap-4 p-4 rounded-lg hover:bg-primary-50 transition-colors">
                            <div class="flex-shrink-0 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                                {{ $index + 1 }}
                            </div>
                            <span class="text-slate-700 text-lg flex-1">{{ $prestasi }}</span>
                            <i class="fas fa-trophy text-yellow-500 text-xl"></i>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </section>
    @endif

    <!-- Struktur Organisasi -->
    @if($structurals->count() > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">Struktur Organisasi</h2>
            </div>
            
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($structurals as $person)
                <div class="text-center group">
                    <div class="relative mb-4 overflow-hidden rounded-2xl">
                        @if($person->photo)
                            <img src="{{ Storage::url($person->photo) }}" alt="{{ $person->name }}" class="w-full aspect-square object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-full aspect-square bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                <i class="fas fa-user text-6xl text-primary-400"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <h3 class="font-bold text-slate-900 text-lg mb-1">{{ $person->name }}</h3>
                    <p class="text-primary-600 font-medium text-sm">{{ $person->position }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
