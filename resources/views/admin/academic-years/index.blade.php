@extends('layouts.admin')

@section('title', 'Manajemen Tahun Ajaran')

@section('content')
    <x-admin.page-header 
        title="Manajemen Tahun Ajaran" 
        description="Kelola tahun ajaran untuk pendaftaran PPDB."
        icon="fas fa-calendar-alt"
        create-route="{{ route('admin.academic-years.create') }}"
        create-label="Tambah Tahun Ajaran"
    />

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded shadow-sm">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        </div>
    @endif

    <!-- Table Section -->
    <div class="bg-white shadow-xl shadow-gray-100 rounded-2xl overflow-hidden border border-gray-100 mt-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-600 uppercase text-xs tracking-wider">
                        <th class="p-4 font-semibold">No</th>
                        <th class="p-4 font-semibold">Tahun Ajaran</th>
                        <th class="p-4 font-semibold">Total Pendaftar</th>
                        <th class="p-4 font-semibold">Status</th>
                        <th class="p-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($academicYears as $index => $year)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-4 text-slate-500">{{ $index + 1 }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center text-primary-600">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <span class="font-medium text-slate-900">{{ $year->tahun }}</span>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 text-sm font-semibold bg-blue-100 text-blue-600 rounded-full">
                                    {{ $year->students_count }} Pendaftar
                                </span>
                            </td>
                            <td class="p-4">
                                @if($year->is_active)
                                    <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-600 rounded-full">Aktif</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold bg-slate-100 text-slate-500 rounded-full">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('admin.academic-years.edit', $year->id) }}" class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:bg-blue-50 rounded-full transition" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($year->students_count == 0)
                                    <form action="{{ route('admin.academic-years.destroy', $year->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tahun ajaran ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:bg-red-50 rounded-full transition" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center justify-center w-8 h-8 text-slate-300 cursor-not-allowed" title="Tidak dapat dihapus karena memiliki pendaftar">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-400">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-calendar-times text-4xl mb-3"></i>
                                    <p>Belum ada tahun ajaran yang ditambahkan.</p>
                                    <a href="{{ route('admin.academic-years.create') }}" class="mt-4 px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                                        Tambah Sekarang
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
