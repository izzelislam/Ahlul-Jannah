@extends('layouts.admin')

@section('title', 'Tambah Kategori Artikel')

@section('content')
<div class="w-full">
    <x-admin.page-header 
        title="Tambah Kategori" 
        description="Buat kategori baru untuk artikel."
        icon="fas fa-plus-circle"
        back-route="{{ route('admin.post-categories.index') }}"
        back-label="Kembali"
    />

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <form action="{{ route('admin.post-categories.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <x-ui.input 
                    label="Nama Kategori" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    placeholder="Contoh: Berita Sekolah"
                />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-400 mt-1">Slug akan dibuat otomatis dari nama kategori.</p>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.post-categories.index') }}">
                    <x-ui.button variant="secondary" type="button">
                        Batal
                    </x-ui.button>
                </a>
                <x-ui.button variant="primary" type="submit">
                    <i class="fas fa-save mr-2"></i> Simpan Kategori
                </x-ui.button>
            </div>
        </form>
    </div>
</div>
@endsection
