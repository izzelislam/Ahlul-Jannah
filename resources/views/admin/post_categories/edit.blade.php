@extends('layouts.admin')

@section('title', 'Edit Kategori Artikel')

@section('content')
<div class="w-full">
    <x-admin.page-header 
        title="Edit Kategori" 
        description="Perbarui informasi kategori."
        icon="fas fa-edit"
        back-route="{{ route('admin.post-categories.index') }}"
        back-label="Kembali"
    />

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <form action="{{ route('admin.post-categories.update', $postCategory->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <x-ui.input 
                    label="Nama Kategori" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $postCategory->name) }}" 
                    required 
                />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

             <!-- Slug (Read Only) -->
            <div>
                 <label class="block text-gray-700 text-sm font-bold mb-2">Slug</label>
                 <input type="text" value="{{ $postCategory->slug }}" disabled class="bg-gray-100 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                 <p class="text-xs text-gray-400 mt-1">Slug akan diperbarui otomatis jika nama berubah.</p>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.post-categories.index') }}">
                    <x-ui.button variant="secondary" type="button">
                        Batal
                    </x-ui.button>
                </a>
                <x-ui.button variant="primary" type="submit">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </x-ui.button>
            </div>
        </form>
    </div>
</div>
@endsection
