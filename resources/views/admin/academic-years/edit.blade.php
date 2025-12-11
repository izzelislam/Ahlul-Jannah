@extends('layouts.admin')

@section('title', 'Edit Tahun Ajaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <x-admin.page-header 
        title="Edit Tahun Ajaran" 
        description="Perbarui informasi tahun ajaran"
        icon="fas fa-calendar-alt"
    />

    <form action="{{ route('admin.academic-years.update', $academicYear) }}" method="POST" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @csrf
        @method('PUT')

        <div class="p-6 space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Ajaran <span class="text-red-500">*</span></label>
                <input type="text" name="tahun" value="{{ old('tahun', $academicYear->tahun) }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                @error('tahun') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                <p class="text-xs text-gray-500 mt-1">Format: 2025/2026</p>
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $academicYear->is_active) ? 'checked' : '' }} class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                <label for="is_active" class="ml-3 text-sm font-medium text-gray-700">Aktifkan sebagai tahun ajaran saat ini</label>
            </div>
        </div>

        <div class="p-6 bg-gray-50 flex items-center justify-between border-t border-gray-200">
            <a href="{{ route('admin.academic-years.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <button type="submit" class="px-6 py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition">
                <i class="fas fa-save mr-2"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
