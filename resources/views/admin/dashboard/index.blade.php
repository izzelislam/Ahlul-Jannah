@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-2xl p-6 mb-8 text-white relative overflow-hidden">
        <div class="absolute right-0 top-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute right-20 bottom-0 w-32 h-32 bg-white/5 rounded-full translate-y-1/2"></div>
        <div class="relative z-10">
            <h1 class="text-2xl font-bold mb-2 text-white">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
            <p class="text-white/80">
                @if($activeYear)
                    Tahun Ajaran Aktif: <span class="font-semibold text-white">{{ $activeYear->tahun }}</span>
                @else
                    Belum ada tahun ajaran aktif
                @endif
            </p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Pendaftar -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Pendaftar</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ $stats['total_pendaftar'] }}</h3>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-user-graduate text-2xl text-blue-600"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-blue-600 font-medium">PPDB {{ $activeYear->tahun ?? '-' }}</span>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Menunggu Verifikasi</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ $stats['pendaftar_pending'] }}</h3>
                </div>
                <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-clock text-2xl text-yellow-600"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.students.index') }}" class="text-sm text-yellow-600 font-medium hover:underline">
                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <!-- Diterima -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Diterima</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ $stats['pendaftar_diterima'] }}</h3>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                </div>
            </div>
            <div class="mt-4">
                @if($stats['total_pendaftar'] > 0)
                    <div class="flex items-center gap-2">
                        <div class="flex-1 bg-slate-100 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ ($stats['pendaftar_diterima'] / $stats['total_pendaftar']) * 100 }}%"></div>
                        </div>
                        <span class="text-xs font-semibold text-green-600">{{ number_format(($stats['pendaftar_diterima'] / $stats['total_pendaftar']) * 100, 1) }}%</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Ditolak -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Ditolak</p>
                    <h3 class="text-3xl font-bold text-slate-900">{{ $stats['pendaftar_ditolak'] }}</h3>
                </div>
                <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-times-circle text-2xl text-red-600"></i>
                </div>
            </div>
            <div class="mt-4">
                @if($stats['total_pendaftar'] > 0)
                    <div class="flex items-center gap-2">
                        <div class="flex-1 bg-slate-100 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width: {{ ($stats['pendaftar_ditolak'] / $stats['total_pendaftar']) * 100 }}%"></div>
                        </div>
                        <span class="text-xs font-semibold text-red-600">{{ number_format(($stats['pendaftar_ditolak'] / $stats['total_pendaftar']) * 100, 1) }}%</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Status Distribution Chart -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900">Distribusi Status</h3>
                <p class="text-sm text-slate-500">Status pendaftaran santri</p>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-slate-600">Pending</span>
                            <span class="text-sm font-bold text-yellow-600">{{ $registrationsByStatus['pending'] }}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3">
                            <div class="bg-yellow-500 h-3 rounded-full transition-all" style="width: {{ $stats['total_pendaftar'] > 0 ? ($registrationsByStatus['pending'] / $stats['total_pendaftar']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-slate-600">Terverifikasi</span>
                            <span class="text-sm font-bold text-blue-600">{{ $registrationsByStatus['verified'] }}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3">
                            <div class="bg-blue-500 h-3 rounded-full transition-all" style="width: {{ $stats['total_pendaftar'] > 0 ? ($registrationsByStatus['verified'] / $stats['total_pendaftar']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-slate-600">Diterima</span>
                            <span class="text-sm font-bold text-green-600">{{ $registrationsByStatus['accepted'] }}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3">
                            <div class="bg-green-500 h-3 rounded-full transition-all" style="width: {{ $stats['total_pendaftar'] > 0 ? ($registrationsByStatus['accepted'] / $stats['total_pendaftar']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-slate-600">Ditolak</span>
                            <span class="text-sm font-bold text-red-600">{{ $registrationsByStatus['rejected'] }}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3">
                            <div class="bg-red-500 h-3 rounded-full transition-all" style="width: {{ $stats['total_pendaftar'] > 0 ? ($registrationsByStatus['rejected'] / $stats['total_pendaftar']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gender Distribution -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900">Distribusi Gender</h3>
                <p class="text-sm text-slate-500">Jenis kelamin pendaftar</p>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-center gap-8">
                    <!-- Laki-laki -->
                    <div class="text-center">
                        <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-mars text-4xl text-blue-600"></i>
                        </div>
                        <p class="text-2xl font-bold text-slate-900">{{ $genderStats['laki'] }}</p>
                        <p class="text-sm text-slate-500">Laki-laki</p>
                    </div>
                    <!-- Perempuan -->
                    <div class="text-center">
                        <div class="w-24 h-24 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-venus text-4xl text-pink-600"></i>
                        </div>
                        <p class="text-2xl font-bold text-slate-900">{{ $genderStats['perempuan'] }}</p>
                        <p class="text-sm text-slate-500">Perempuan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900">Website Stats</h3>
                <p class="text-sm text-slate-500">Statistik konten website</p>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-purple-600"></i>
                        </div>
                        <span class="font-medium text-slate-700">Users</span>
                    </div>
                    <span class="text-lg font-bold text-slate-900">{{ $stats['total_users'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-newspaper text-orange-600"></i>
                        </div>
                        <span class="font-medium text-slate-700">Posts</span>
                    </div>
                    <span class="text-lg font-bold text-slate-900">{{ $stats['total_posts'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-images text-teal-600"></i>
                        </div>
                        <span class="font-medium text-slate-700">Galleries</span>
                    </div>
                    <span class="text-lg font-bold text-slate-900">{{ $stats['total_galleries'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-list-alt text-indigo-600"></i>
                        </div>
                        <span class="font-medium text-slate-700">Programs</span>
                    </div>
                    <span class="text-lg font-bold text-slate-900">{{ $stats['total_programs'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Registrations Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Pendaftar Terbaru</h3>
                <p class="text-sm text-slate-500">5 pendaftaran terakhir</p>
            </div>
            <a href="{{ route('admin.students.index') }}" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-lg transition-colors">
                Lihat Semua
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Sekolah Asal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">No. HP</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentStudents as $student)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                                        <span class="text-primary-600 font-bold text-sm">{{ strtoupper(substr($student->nama, 0, 2)) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-900">{{ $student->nama }}</p>
                                        <p class="text-xs text-slate-500">{{ $student->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $student->sekolah_asal }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $student->no_hp }}</td>
                            <td class="px-6 py-4">
                                @switch($student->status)
                                    @case('pending')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        @break
                                    @case('verified')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Terverifikasi</span>
                                        @break
                                    @case('accepted')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Diterima</span>
                                        @break
                                    @case('rejected')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $student->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.students.show', $student) }}" class="text-primary-600 hover:text-primary-800 font-medium text-sm">
                                    Detail <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                <i class="fas fa-inbox text-4xl mb-3"></i>
                                <p>Belum ada pendaftar</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection