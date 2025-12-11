@extends('layouts.admin')

@section('title', 'Tambah Program')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Program Baru</h1>
            <a href="{{ route('admin.programs.index') }}" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <p class="text-gray-500">Isi formulir berikut untuk menambahkan program baru.</p>
            </div>

            <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Program <span class="text-red-500">*</span></label>
                        <input type="text" name="title" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-primary-500 outline-none transition" required placeholder="Contoh: Program Takhasus">
                    </div>

                    <!-- Subtitle -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Subtitle (Opsional)</label>
                        <input type="text" name="subtitle" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-primary-500 outline-none transition" placeholder="Contoh: Fokus Hafalan 30 Juz">
                    </div>
                </div>

                <!-- Description (Short) -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Singkat</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-primary-500 outline-none transition" placeholder="Deskripsi singkat untuk ditampilkan di kartu program..."></textarea>
                </div>

                <!-- Content (Full) -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Lengkap</label>
                    <textarea name="content" rows="6" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-primary-500 outline-none transition" placeholder="Penjelasan lengkap tentang program ini..."></textarea>
                </div>

                 <div class="grid md:grid-cols-2 gap-6">
                    <!-- Image -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Gambar / Icon</label>
                        <input type="file" name="image" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-primary-500 outline-none transition text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                        <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG, GIF. Max: 2MB.</p>
                    </div>

                    <!-- Order -->
                     <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Urutan Tampil</label>
                        <input type="number" name="urutan" value="0" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-primary-500 outline-none transition">
                    </div>
                </div>

                 <!-- Tags -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tags / Kategori (Pisahkan dengan koma)</label>
                    <input type="text" name="tags" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-primary-500 outline-none transition" placeholder="Contoh: Putra, Putri, Asrama">
                </div>

                <!-- Status Checkbox -->
                <div class="flex items-center gap-3">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" value="1" id="is_published" class="w-5 h-5 text-primary-600 border-slate-300 rounded focus:ring-primary-500" checked>
                    <label for="is_published" class="text-slate-700 font-medium">Publikasikan Program Ini</label>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.programs.index') }}">
                        <button type="button" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                            Batal
                        </button>
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-lg transition transform hover:-translate-y-0.5">
                        Simpan Program
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
