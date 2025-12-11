@extends('layouts.admin')

@section('title', 'Detail Pendaftar')

@section('content')
<div class="w-full">
    <x-admin.page-header 
        title="Detail Pendaftar" 
        description="Informasi lengkap data calon santri"
        icon="fas fa-user"
    />

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Data Santri -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                    <h3 class="text-lg font-bold text-white"><i class="fas fa-user mr-2"></i> Data Calon Santri</h3>
                </div>
                <div class="p-6">
                    <dl class="grid md:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                            <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $student->nama }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">NISN</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $student->nisn ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($student->tanggal_lahir)->format('d F Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $student->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                        </div>
                        <div class="md:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $student->alamat }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Sekolah Asal</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $student->sekolah_asal }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Data Orang Tua -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
                    <h3 class="text-lg font-bold text-white"><i class="fas fa-users mr-2"></i> Data Orang Tua / Wali</h3>
                </div>
                <div class="p-6">
                    <dl class="grid md:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama Ayah</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $student->nama_ayah }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama Ibu</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $student->nama_ibu }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">No. HP / WhatsApp</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $student->no_hp) }}" target="_blank" class="text-green-600 hover:underline">
                                    {{ $student->no_hp }} <i class="fab fa-whatsapp ml-1"></i>
                                </a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $student->email ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Status Pendaftaran</h3>
                </div>
                <div class="p-6">
                    <div class="text-center mb-4">
                        @switch($student->status)
                            @case('pending')
                                <span class="px-4 py-2 inline-flex text-sm font-bold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @break
                            @case('verified')
                                <span class="px-4 py-2 inline-flex text-sm font-bold rounded-full bg-blue-100 text-blue-800">Terverifikasi</span>
                                @break
                            @case('accepted')
                                <span class="px-4 py-2 inline-flex text-sm font-bold rounded-full bg-green-100 text-green-800">Diterima</span>
                                @break
                            @case('rejected')
                                <span class="px-4 py-2 inline-flex text-sm font-bold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                @break
                        @endswitch
                    </div>

                    <form action="{{ route('admin.students.updateStatus', $student) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ubah Status:</label>
                        <select name="status" class="w-full rounded-lg border-gray-300 mb-3">
                            <option value="pending" {{ $student->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="verified" {{ $student->status == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="accepted" {{ $student->status == 'accepted' ? 'selected' : '' }}>Diterima</option>
                            <option value="rejected" {{ $student->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        <button type="submit" class="w-full px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition">
                            Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Informasi</h3>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Tahun Ajaran</span>
                        <span class="font-medium">{{ $student->academicYear->name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Tanggal Daftar</span>
                        <span class="font-medium">{{ $student->created_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-3">
                <a href="{{ route('admin.students.edit', $student) }}" class="flex-1 px-4 py-2 bg-yellow-500 text-white text-center font-semibold rounded-lg hover:bg-yellow-600 transition">
                    <i class="fas fa-edit mr-1"></i> Edit
                </a>
                <a href="{{ route('admin.students.index') }}" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 text-center font-semibold rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
