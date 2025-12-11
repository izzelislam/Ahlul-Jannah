@extends('layouts.landing')

@section('title', 'PPDB - Penerimaan Peserta Didik Baru')

@php
    $content = $page->content ?? [];
    $hero = $content['hero'] ?? [];
    $info = $content['info'] ?? [];
    $requirements = $content['requirements'] ?? [];
    $flow = $content['flow'] ?? [];
    $brochure = $content['brochure'] ?? [];
    $contact = $content['contact'] ?? [];
@endphp

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-32 pb-24 text-white overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/ppdb/hero-bg.png') }}" alt="Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-primary-900/90 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-primary-900/95 via-primary-800/90 to-blue-900/90"></div>
        </div>

        <div class="absolute inset-0 bg-pattern opacity-5 z-0"></div>
        <div class="absolute inset-0 z-0">
            <div class="absolute top-20 left-10 w-72 h-72 bg-primary-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-20 left-1/2 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-4000"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-block mb-6">
                    <span class="bg-white/20 backdrop-blur-sm px-6 py-2 rounded-full text-sm font-semibold border border-white/30">
                        <i class="fas fa-calendar-alt mr-2"></i> {{ $hero['badge'] ?? 'Pendaftaran Dibuka!' }}
                    </span>
                </div>
                <h1 class="text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    {{ $hero['title'] ?? 'Penerimaan Peserta Didik Baru' }}
                    <span class="block text-primary-200">{{ $hero['subtitle'] ?? 'Tahun Ajaran 2025/2026' }}</span>
                </h1>
                <p class="text-xl text-primary-100 mb-8 leading-relaxed">
                    {{ $hero['description'] ?? 'Bergabunglah dengan Pondok Pesantren Tahfidz Ahlul Jannah Takalar. Wujudkan impian menjadi penghafal Al-Quran yang berakhlak mulia.' }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('landing.pendaftaran.form') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-700 font-bold rounded-full shadow-2xl hover:shadow-primary-500/50 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                        <i class="fas fa-edit mr-3 text-xl"></i>
                        Daftar Sekarang
                    </a>
                    <a href="#syarat-ketentuan" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-full border-2 border-white/30 hover:bg-white/20 transition-all duration-300">
                        <i class="fas fa-info-circle mr-3"></i>
                        Lihat Persyaratan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Pendaftaran -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl border border-blue-200 hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl shadow-lg shadow-blue-600/30">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Periode Pendaftaran</h3>
                    <p class="text-slate-600 font-medium">{{ $info['registration_period'] ?? '1 Januari - 30 Juni 2025' }}</p>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl border border-green-200 hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl shadow-lg shadow-green-600/30">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Biaya Pendaftaran</h3>
                    <p class="text-slate-600 font-medium">{{ $info['registration_fee'] ?? 'GRATIS' }}</p>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl border border-purple-200 hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white text-2xl shadow-lg shadow-purple-600/30">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Kuota Tersedia</h3>
                    <p class="text-slate-600 font-medium">{{ $info['quota'] ?? '100 Santri' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Brosur Section -->
    <section class="py-20 bg-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="relative group">
                    <div class="absolute -inset-4 bg-gradient-to-r from-primary-600 to-purple-600 rounded-xl blur-lg opacity-30 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative bg-white rounded-xl shadow-2xl overflow-hidden border border-slate-200">
                        <!-- Brochure Image -->
                        <div class="aspect-[3/4] bg-slate-200 flex items-center justify-center relative overflow-hidden">
                            @if(isset($brochure['image']) && $brochure['image'])
                                <img src="{{ Storage::url($brochure['image']) }}" alt="Brosur PPDB" class="w-full h-full object-cover">
                            @else
                                <div class="text-center">
                                    <i class="fas fa-file-pdf text-6xl text-slate-300 mb-4"></i>
                                    <p class="text-slate-400 font-medium">Preview Brosur PPDB</p>
                                </div>
                                <!-- Decorative bg pattern -->
                                <div class="absolute inset-0 bg-gradient-to-tr from-slate-100/50 to-transparent"></div>
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <span class="text-primary-600 font-semibold tracking-wide uppercase text-sm mb-2 block">Informasi Lengkap</span>
                    <h2 class="text-4xl font-bold text-slate-900 mb-6">{{ $brochure['title'] ?? 'Unduh Brosur PPDB' }}</h2>
                    <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                        {{ $brochure['description'] ?? 'Dapatkan informasi lengkap mengenai kurikulum, fasilitas, kegiatan, dan rincian biaya pendidikan di Pondok Pesantren Tahfidz Ahlul Jannah melalui brosur digital kami.' }}
                    </p>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0 text-primary-600">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900">Profil Lengkap</h4>
                                <p class="text-sm text-slate-600">Gambaran umum tentang pesantren dan visi misi.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0 text-primary-600">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900">Program Unggulan</h4>
                                <p class="text-sm text-slate-600">Detail program Tahfidz dan program penunjang lainnya.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0 text-primary-600">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900">Fasilitas</h4>
                                <p class="text-sm text-slate-600">Informasi mengenai asrama, kelas, dan sarana prasarana.</p>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="inline-flex items-center px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-lg transition-colors">
                        <i class="fas fa-download mr-2"></i>
                        Download Brosur PDF
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Pendaftaran -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-primary-600 font-semibold tracking-wide uppercase text-sm mb-2 block">Proses Mudah</span>
                <h2 class="text-4xl font-bold text-slate-900">Alur Pendaftaran</h2>
            </div>
            
            <div class="relative">
                <!-- Connecting Line (Desktop) -->
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-1 bg-slate-100 -translate-y-1/2 z-0"></div>
                
                <div class="grid md:grid-cols-4 gap-8 relative z-10">
                    @php
                        $defaultFlow = [
                            ['step' => 1, 'title' => 'Daftar Online', 'description' => 'Isi formulir pendaftaran melalui website resmi kami.'],
                            ['step' => 2, 'title' => 'Verifikasi Berkas', 'description' => 'Admin akan memverifikasi data dan berkas yang Anda kirimkan.'],
                            ['step' => 3, 'title' => 'Tes Masuk', 'description' => 'Ikuti tes seleksi masuk (baca Al-Quran & wawancara).'],
                            ['step' => 4, 'title' => 'Daftar Ulang', 'description' => 'Lakukan pembayaran dan validasi data final jika diterima.'],
                        ];
                        $flowItems = !empty($flow) ? $flow : $defaultFlow;
                    @endphp
                    @foreach($flowItems as $item)
                    <div class="bg-white p-6 rounded-xl border border-slate-200 text-center hover:shadow-lg transition-all duration-300 group">
                        <div class="w-16 h-16 mx-auto bg-white border-4 border-primary-100 rounded-full flex items-center justify-center text-2xl font-bold text-primary-600 mb-4 group-hover:border-primary-500 group-hover:bg-primary-500 group-hover:text-white transition-all shadow-sm">
                            {{ $item['step'] ?? $loop->iteration }}
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $item['title'] ?? '' }}</h3>
                        <p class="text-sm text-slate-600">{{ $item['description'] ?? '' }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Syarat & Ketentuan -->
    <section id="syarat-ketentuan" class="py-20 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-primary-600 font-semibold tracking-wide uppercase text-sm mb-2 block">Ketentuan</span>
                <h2 class="text-4xl font-bold text-slate-900 mb-4">Syarat & Ketentuan</h2>
                <p class="text-slate-600 text-lg">Pastikan Anda memenuhi persyaratan berikut sebelum mendaftar</p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Requirements Card -->
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                            <i class="fas fa-user-graduate text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Persyaratan Umum</h3>
                    </div>
                    <ul class="space-y-4">
                        @php
                            $generalReqs = $requirements['general'] ?? [
                                'Lulus SD/MI atau sederajat',
                                'Usia maksimal 15 tahun pada bulan Juli',
                                'Sehat jasmani dan rohani (Surat Keterangan Dokter)',
                                'Bersedia tinggal di asrama',
                                'Siap mematuhi aturan pesantren',
                            ];
                        @endphp
                        @foreach($generalReqs as $req)
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 mt-1 flex-shrink-0"></i>
                            <span class="text-slate-700">{{ $req }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Documents Card -->
                <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600">
                            <i class="fas fa-file-alt text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Berkas Dokumen</h3>
                    </div>
                    <ul class="space-y-4">
                        @php
                            $documents = $requirements['documents'] ?? [
                                'Fotocopy Ijazah SD/MI yang dilegalisir (2 lembar)',
                                'Fotocopy Akta Kelahiran (2 lembar)',
                                'Fotocopy Kartu Keluarga (2 lembar)',
                                'Pas foto berwarna 3x4 (4 lembar)',
                            ];
                        @endphp
                        @foreach($documents as $doc)
                        <li class="flex items-start gap-3">
                            <i class="fas fa-file-invoice text-slate-400 mt-1 flex-shrink-0"></i>
                            <span class="text-slate-700">{{ $doc }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA To Form -->
    <section class="py-24 text-white relative overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/ppdb/cta-bg.png') }}" alt="Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-primary-900/90 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-primary-900/80 to-primary-800/80"></div>
        </div>

        <div class="absolute inset-0 bg-pattern opacity-10"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-4xl font-bold mb-6">Siap Menjadi Bagian Dari Kami?</h2>
            <p class="text-xl text-primary-200 mb-10 max-w-2xl mx-auto">
                Jangan lewatkan kesempatan emas ini. Segera daftarkan diri Anda dan jadilah penghafal Al-Quran generasi masa depan.
            </p>
            <a href="{{ route('landing.pendaftaran.form') }}" class="inline-flex items-center justify-center px-10 py-5 bg-white text-primary-800 font-bold text-lg rounded-full shadow-2xl hover:shadow-white/20 hover:bg-slate-100 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                <i class="fas fa-paper-plane mr-3"></i>
                Isi Formulir Pendaftaran Sekarang
            </a>
            <p class="mt-6 text-sm text-primary-300">
                <i class="fas fa-lock mr-2"></i> Pendaftaran online aman dan cepat
            </p>
        </div>
    </section>

    <!-- Support Section -->
    <section class="py-12 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                    <i class="fab fa-whatsapp text-2xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900">Butuh Bantuan?</h4>
                    <p class="text-sm text-slate-600">Hubungi panitia PPDB kami via WhatsApp</p>
                </div>
            </div>
            <a href="https://wa.me/{{ $contact['whatsapp'] ?? '6281234567890' }}" target="_blank" class="px-6 py-3 bg-white border-2 border-slate-200 hover:border-green-500 hover:text-green-600 text-slate-700 font-semibold rounded-lg transition-colors">
                Chat Panitia
            </a>
        </div>
    </section>

    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
@endsection
