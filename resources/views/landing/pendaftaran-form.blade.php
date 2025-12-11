@extends('layouts.landing')

@section('title', 'Formulir PPDB - Pondok Pesantren Tahfidz Ahlul Jannah')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 text-white overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/ppdb/hero-bg.png') }}" alt="Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-primary-900/90 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-primary-900/95 via-primary-800/90 to-blue-900/90"></div>
        </div>

        <div class="absolute inset-0 bg-pattern opacity-5 z-0"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl lg:text-5xl font-bold mb-4">Formulir Pendaftaran</h1>
            <p class="text-primary-100 text-lg max-w-2xl mx-auto">Silakan lengkapi data calon santri dan orang tua dengan benar dan teliti.</p>
        </div>
    </section>

    <div class="py-12 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Success Alert -->
            @if(session('success'))
                <div class="mb-8 p-6 bg-green-50 border-l-4 border-green-500 rounded-lg shadow-lg">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-600 text-3xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-green-800 mb-1">Pendaftaran Berhasil!</h3>
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-green-600 hover:text-green-800">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
            @endif

            <form action="{{ route('landing.pendaftaran.store') }}" method="POST" class="bg-white border-2 border-slate-200 rounded-2xl shadow-xl p-8">
                @csrf
                
                <!-- Data Santri -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-slate-900 mb-6 pb-3 border-b-2 border-primary-200">
                        <i class="fas fa-user text-primary-600 mr-2"></i> Data Calon Santri
                    </h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" required class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Nama lengkap sesuai ijazah">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">NISN</label>
                            <input type="text" name="nisn" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Nomor Induk Siswa Nasional">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lahir" required class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jenis_kelamin" required class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea name="alamat" required rows="3" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Alamat lengkap tempat tinggal"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Sekolah Asal <span class="text-red-500">*</span></label>
                            <input type="text" name="sekolah_asal" required class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Nama sekolah asal">
                        </div>
                    </div>
                </div>

                <!-- Data Orang Tua -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-slate-900 mb-6 pb-3 border-b-2 border-primary-200">
                        <i class="fas fa-users text-primary-600 mr-2"></i> Data Orang Tua / Wali
                    </h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Ayah <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ayah" required class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Nama lengkap ayah">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Ibu <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ibu" required class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Nama lengkap ibu">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                            <input type="tel" name="no_hp" required class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="08xxxxxxxxxx">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                            <input type="email" name="email" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="email@example.com">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between pt-6 border-t border-slate-200">
                    <p class="text-sm text-slate-500"><span class="text-red-500">*</span> Wajib diisi</p>
                    <button type="submit" class="px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-full shadow-lg shadow-primary-600/30 transition-all duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
