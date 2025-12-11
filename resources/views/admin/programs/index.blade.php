@extends('layouts.admin')

@section('title', 'Manajemen Program')

@section('content')
    <x-admin.page-header 
        title="Manajemen Program" 
        description="Kelola daftar program unggulan pondok pesantren."
        icon="fas fa-list-alt"
        create-route="{{ route('admin.programs.create') }}"
        create-label="Tambah Program"
    />

    <!-- Table Section with simple styling since filter is not yet implemented fully but header is updated -->
    <div class="bg-white shadow-xl shadow-gray-100 rounded-2xl overflow-hidden border border-gray-100 mt-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-600 uppercase text-xs tracking-wider">
                        <th class="p-4 font-semibold">No</th>
                        <th class="p-4 font-semibold">Image</th>
                        <th class="p-4 font-semibold">Judul Program</th>
                        <th class="p-4 font-semibold">Subtitle</th>
                        <th class="p-4 font-semibold">Status</th>
                        <th class="p-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($programs as $index => $program)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-4 text-slate-500">{{ $index + 1 }}</td>
                            <td class="p-4">
                                @if($program->image)
                                    <img src="{{ Storage::url($program->image) }}" alt="{{ $program->title }}" class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="p-4 font-medium text-slate-900">{{ $program->title }}</td>
                            <td class="p-4 text-slate-600">{{ $program->subtitle ?? '-' }}</td>
                            <td class="p-4">
                                @if($program->is_published)
                                    <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-600 rounded-full">Published</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold bg-slate-100 text-slate-500 rounded-full">Draft</span>
                                @endif
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('admin.programs.edit', $program->id) }}" class="inline-flex items-center justify-center w-8 h-8 text-blue-600 hover:bg-blue-50 rounded-full transition" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.programs.destroy', $program->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:bg-red-50 rounded-full transition" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-400">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-folder-open text-4xl mb-3"></i>
                                    <p>Belum ada program yang ditambahkan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
