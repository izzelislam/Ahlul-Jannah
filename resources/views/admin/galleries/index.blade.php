@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@section('content')
    <x-admin.page-header 
        title="Manajemen Galeri" 
        description="Kelola foto dan video dokumentasi kegiatan."
        icon="fas fa-images"
        create-route="{{ route('admin.galleries.create') }}"
        create-label="Tambah Galeri"
    />

    <!-- Filter & Search Section -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8 transition-all hover:shadow-md">
        <form action="{{ route('admin.galleries.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <!-- Search -->
            <div class="md:col-span-8 relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari judul galeri..." 
                    class="pl-10 block w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition-all duration-200"
                >
            </div>
            
            <!-- Type Filter -->
            <div class="md:col-span-2 relative">
                <select name="type" class="block w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition-all duration-200 appearance-none">
                    <option value="">Semua Tipe</option>
                    @foreach($types as $t)
                        <option value="{{ $t }}" {{ request('type') == $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit -->
            <div class="md:col-span-2">
                <button type="submit" class="w-full bg-gray-800 hover:bg-gray-900 text-white font-semibold py-3 px-6 rounded-xl shadow-lg shadow-gray-200 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($galleries as $gallery)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group hover:shadow-xl transition-all duration-300">
                <div class="relative h-48 bg-gray-200 overflow-hidden">
                    @if($gallery->type == 'image')
                        <img src="{{ Storage::url($gallery->file_path) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    @else
                        <video class="w-full h-full object-cover">
                            <source src="{{ Storage::url($gallery->file_path) }}" type="video/mp4">
                            Browser anda tidak mendukung tag video.
                        </video>
                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                             <i class="fas fa-play-circle text-4xl text-white opacity-80"></i>
                        </div>
                    @endif
                    
                    <div class="absolute top-2 right-2">
                        <span class="px-2 py-1 bg-white bg-opacity-90 rounded-lg text-xs font-bold shadow-sm {{ $gallery->type == 'image' ? 'text-purple-600' : 'text-pink-600' }}">
                            <i class="{{ $gallery->type == 'image' ? 'fas fa-image' : 'fas fa-video' }} mr-1"></i> {{ ucfirst($gallery->type) }}
                        </span>
                    </div>
                </div>
                
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-1 truncate" title="{{ $gallery->title }}">{{ $gallery->title }}</h3>
                    <p class="text-xs text-gray-500 mb-4">{{ $gallery->created_at->format('d M Y') }}</p>
                    
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium transition-colors">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <button onclick="confirmDelete('{{ $gallery->id }}', '{{ $gallery->title }}')" class="text-red-500 hover:text-red-700 text-sm font-medium transition-colors">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                         <form id="delete-form-{{ $gallery->id }}" action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center">
                 <div class="bg-gray-50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="far fa-images text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Belum ada galeri</h3>
                <p class="text-gray-500 mt-1">Silakan tambahkan foto atau video baru.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($galleries->hasPages())
    <div class="mt-8">
       {{ $galleries->links() }}
    </div>
    @endif

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
                        Hapus Galeri?
                    </h3>
                    <div class="mt-2">
                         <p class="text-sm text-gray-500">
                            Apakah Anda yakin ingin menghapus galeri <strong id="deleteTitle" class="text-gray-900"></strong>? <br>
                            <span class="text-red-500 text-xs mt-1 block">File fisik juga akan dihapus dari server.</span>
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
