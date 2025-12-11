@extends('layouts.admin')

@section('title', 'Edit Pendaftar')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-admin.page-header 
        title="Edit Data Pendaftar" 
        description="Perbarui informasi data calon santri"
        icon="fas fa-user-edit"
    />

    <form action="{{ route('admin.students.update', $student) }}" method="POST" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @csrf
        @method('PUT')

        <!-- Data Santri -->
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900 mb-6"><i class="fas fa-user text-primary-600 mr-2"></i> Data Calon Santri</h3>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $student->nama) }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                    @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">NISN</label>
                    <input type="text" name="nisn" value="{{ old('nisn', $student->nisn) }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $student->tanggal_lahir) }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="jenis_kelamin" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                        <option value="L" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat <span class="text-red-500">*</span></label>
                    <textarea name="alamat" rows="3" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200">{{ old('alamat', $student->alamat) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Sekolah Asal <span class="text-red-500">*</span></label>
                    <input type="text" name="sekolah_asal" value="{{ old('sekolah_asal', $student->sekolah_asal) }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                </div>
            </div>
        </div>

        <!-- Data Orang Tua -->
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900 mb-6"><i class="fas fa-users text-purple-600 mr-2"></i> Data Orang Tua / Wali</h3>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Ayah <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $student->nama_ayah) }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Ibu <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $student->nama_ibu) }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                    <input type="tel" name="no_hp" value="{{ old('no_hp', $student->no_hp) }}" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $student->email) }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                </div>
            </div>
        </div>

        <!-- Status & Tahun Ajaran -->
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900 mb-6"><i class="fas fa-cog text-gray-600 mr-2"></i> Pengaturan</h3>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                        <option value="pending" {{ old('status', $student->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="verified" {{ old('status', $student->status) == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                        <option value="accepted" {{ old('status', $student->status) == 'accepted' ? 'selected' : '' }}>Diterima</option>
                        <option value="rejected" {{ old('status', $student->status) == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Ajaran <span class="text-red-500">*</span></label>
                    <select name="academic_year_id" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                        @foreach($academicYears as $year)
                            <option value="{{ $year->id }}" {{ old('academic_year_id', $student->academic_year_id) == $year->id ? 'selected' : '' }}>Tahun Ajaran {{ $year->tahun }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="p-6 bg-gray-50 flex items-center justify-between">
            <a href="{{ route('admin.students.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <button type="submit" class="px-6 py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition">
                <i class="fas fa-save mr-2"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
