@extends('layouts.admin')

@section('title', 'Manajemen Post')

@section('content')
    <x-admin.page-header 
        title="Manajemen Post" 
        description="Kelola artikel dan berita sekolah."
        icon="fas fa-newspaper"
        create-route="{{ route('admin.posts.create') }}"
        create-label="Tambah Post"
    />

    <!-- Filter & Search Section -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8 transition-all hover:shadow-md">
        <form action="{{ route('admin.posts.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <!-- Search -->
            <div class="md:col-span-6 relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari judul artikel..." 
                    class="pl-10 block w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all duration-200"
                >
            </div>
            
            <!-- Category Filter -->
            <div class="md:col-span-4 relative">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-filter text-gray-400"></i>
                    </div>
                    <select name="category_id" class="pl-10 block w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all duration-200 appearance-none">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="md:col-span-2">
                <button type="submit" class="w-full bg-gray-800 hover:bg-gray-900 text-white font-semibold py-3 px-6 rounded-xl shadow-lg shadow-gray-200 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="bg-white shadow-xl shadow-gray-100 rounded-2xl overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Artikel</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4">Penulis</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($posts as $post)
                        <tr class="hover:bg-gray-50 transition-colors duration-150 group">
                            <td class="px-6 py-4 bg-white group-hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-16 h-12 bg-gray-200 rounded-lg overflow-hidden relative">
                                        @if($post->thumbnail)
                                            <img src="{{ Storage::url($post->thumbnail) }}" alt="" class="w-full h-full object-cover">
                                        @else
                                            <div class="flex items-center justify-center h-full text-gray-400">
                                                <i class="fas fa-newspaper"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4 max-w-xs">
                                        <p class="text-sm font-bold text-gray-900 truncate" title="{{ $post->title }}">{{ $post->title }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ Str::limit(strip_tags($post->content), 50) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 bg-white group-hover:bg-gray-50">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-600 border border-blue-100">
                                    {{ $post->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 bg-white group-hover:bg-gray-50 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $post->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    <span class="w-2 h-2 mr-1.5 rounded-full {{ $post->is_published ? 'bg-green-400' : 'bg-gray-400' }}"></span>
                                    {{ $post->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 bg-white group-hover:bg-gray-50">
                                <p class="text-xs text-gray-600 font-medium">
                                    <i class="fas fa-user-circle mr-1 text-gray-400"></i>
                                    {{ $post->author->name ?? 'Unknown' }}
                                </p>
                            </td>
                            <td class="px-6 py-4 bg-white group-hover:bg-gray-50">
                                <div class="text-sm text-gray-600">{{ $post->created_at->format('d M Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $post->created_at->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 bg-white group-hover:bg-gray-50 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="group/btn relative">
                                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center transition-all hover:bg-blue-600 hover:text-white shadow-sm hover:shadow-blue-200">
                                            <i class="fas fa-pen text-xs"></i>
                                        </div>
                                    </a>
                                    
                                    <button 
                                        onclick="confirmDelete('{{ $post->id }}', '{{ $post->title }}')" 
                                        class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center transition-all hover:bg-red-600 hover:text-white shadow-sm hover:shadow-red-200"
                                    >
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                    <form id="delete-form-{{ $post->id }}" action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-100 rounded-full p-6 mb-4">
                                        <i class="far fa-newspaper text-4xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900">Belum ada post</h3>
                                    <p class="text-gray-500 mt-1 max-w-sm">Silakan buat artikel baru untuk ditampilkan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($posts->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex flex-col xs:flex-row items-center xs:justify-between">
            <div class="text-sm text-gray-500 mb-2 xs:mb-0">
                Menampilkan <span class="font-semibold">{{ $posts->firstItem() ?? 0 }}</span> sampai <span class="font-semibold">{{ $posts->lastItem() ?? 0 }}</span> dari <span class="font-semibold">{{ $posts->total() }}</span> post
            </div>
            <div class="inline-flex rounded-md shadow-sm">
               {{ $posts->links('pagination::tailwind') }}
            </div>
        </div>
        @endif
    </div>
@endsection

@section('modals')
    <x-ui.modal id="deleteModal">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-50 sm:mx-0 sm:h-10 sm:w-10">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Hapus Post?
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            Apakah Anda yakin ingin menghapus post <strong id="deleteTitle" class="text-gray-900"></strong>? <br>
                            <span class="text-red-500 text-xs mt-1 block">Tindakan ini tidak dapat dibatalkan.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
            <x-ui.button variant="danger" id="confirmDeleteAction" class="w-full sm:w-auto">
                <i class="fas fa-trash-alt mr-1"></i> Ya, Hapus
            </x-ui.button>
            <x-ui.button variant="secondary" id="cancelDeleteAction" class="mt-3 sm:mt-0 w-full sm:w-auto">
                Batal
            </x-ui.button>
        </div>
    </x-ui.modal>
@endsection

@push('scripts')
<script>
    let deleteId = null;
    const deleteModal = document.getElementById('deleteModal');

    function toggleDeleteModal(show) {
        if(show) {
            deleteModal.classList.remove('hidden');
        } else {
            deleteModal.classList.add('hidden');
        }
    }

    function confirmDelete(id, title) {
        deleteId = id;
        document.getElementById('deleteTitle').textContent = title;
        toggleDeleteModal(true);
    }

    document.getElementById('cancelDeleteAction').addEventListener('click', () => {
        toggleDeleteModal(false);
        deleteId = null;
    });

    document.getElementById('confirmDeleteAction').addEventListener('click', () => {
        if(deleteId) {
            document.getElementById('delete-form-' + deleteId).submit();
        }
    });
</script>
@endpush
