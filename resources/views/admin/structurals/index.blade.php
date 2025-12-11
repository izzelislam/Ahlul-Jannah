@extends('layouts.admin')

@section('title', 'Manajemen Struktural')

@section('content')
    <x-admin.page-header 
        title="Manajemen Struktural" 
        description="Kelola struktur organisasi sekolah."
        icon="fas fa-sitemap"
        create-route="{{ route('admin.structurals.create') }}"
        create-label="Tambah Anggota"
    />

    <!-- Search Section -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8 transition-all hover:shadow-md">
        <form action="{{ route('admin.structurals.index') }}" method="GET" class="grid grid-cols-1 gap-4">
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau jabatan..." 
                    class="pl-10 block w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all duration-200"
                >
            </div>
        </form>
    </div>

    <!-- Grid View for Personnels -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($structurals as $person)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col items-center p-6 text-center">
                <div class="w-32 h-32 rounded-full mb-4 relative group">
                    @if($person->foto)
                        <img src="{{ Storage::url($person->foto) }}" alt="{{ $person->nama }}" class="w-full h-full rounded-full object-cover border-4 border-white shadow-md">
                    @else
                        <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center text-gray-400 border-4 border-white shadow-md">
                            <i class="fas fa-user text-4xl"></i>
                        </div>
                    @endif
                    <div class="absolute bottom-0 right-0 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full border-2 border-white">
                        #{{ $person->urutan }}
                    </div>
                </div>
                
                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $person->nama }}</h3>
                <p class="text-sm text-blue-600 font-medium mb-4">{{ $person->jabatan }}</p>
                
                <div class="flex items-center justify-center gap-3 w-full pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.structurals.edit', $person->id) }}" class="text-gray-500 hover:text-blue-600 transition-colors" title="Edit">
                        <i class="fas fa-pen"></i>
                    </a>
                    <button onclick="confirmDelete('{{ $person->id }}', '{{ $person->nama }}')" class="text-gray-500 hover:text-red-600 transition-colors" title="Hapus">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <form id="delete-form-{{ $person->id }}" action="{{ route('admin.structurals.destroy', $person->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center">
                 <div class="bg-gray-50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-sitemap text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Belum ada data struktur</h3>
                <p class="text-gray-500 mt-1">Silakan tambahkan anggota struktural baru.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($structurals->hasPages())
    <div class="mt-8">
       {{ $structurals->links('pagination::tailwind') }}
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
                        Hapus Anggota?
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            Apakah Anda yakin ingin menghapus <strong id="deleteName" class="text-gray-900"></strong> dari struktur organisasi? <br>
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

    function confirmDelete(id, name) {
        deleteId = id;
        document.getElementById('deleteName').textContent = name;
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
