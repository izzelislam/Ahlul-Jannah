@extends('layouts.admin')

@section('title', 'Tambah Halaman Baru')

@section('content')
<div class="max-w-full mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Halaman Baru</h1>
        <a href="{{ route('admin.pages.index') }}" class="text-gray-600 hover:text-gray-900">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <p class="text-gray-500">Isi formulir berikut untuk menambahkan halaman baru.</p>
        </div>

        <form action="{{ route('admin.pages.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Halaman</label>
                <input type="text" name="title" id="title" class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-200 transition" placeholder="Masukkan judul halaman" required>
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_published" id="is_published" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500" value="1" checked>
                <label for="is_published" class="ml-2 block text-sm text-gray-900">Publish Halaman</label>
            </div>

            <div class="bg-blue-50 p-4 rounded-lg flex items-start gap-3">
                 <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                 <p class="text-sm text-blue-700">Untuk saat ini, pembuatan halaman baru hanya mendukung halaman standar. Fitur editor konten dinamis akan segera hadir.</p>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.pages.index') }}">
                    <button type="button" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </button>
                </a>
                <button type="submit" class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-lg transition transform hover:-translate-y-0.5">
                    Simpan Halaman
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
