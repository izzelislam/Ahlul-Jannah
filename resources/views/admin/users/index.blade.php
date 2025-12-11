@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
    <x-admin.page-header 
        title="Manajemen Pengguna" 
        description="Kelola data pengguna, peran, dan hak akses sistem."
        icon="fas fa-users"
        create-route="{{ route('admin.users.create') }}"
        create-label="Tambah Pengguna"
    />

    <!-- Filter & Search Section -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8 transition-all hover:shadow-md">
        <form action="{{ route('admin.users.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <!-- Search -->
            <div class="md:col-span-5 relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau email..." 
                    class="pl-10 block w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all duration-200"
                >
            </div>
            
            <!-- Role Filter -->
            <div class="md:col-span-4 relative">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-filter text-gray-400"></i>
                    </div>
                    <select name="role" class="pl-10 block w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all duration-200 appearance-none">
                        <option value="">Semua Role</option>
                        @foreach($roles as $r)
                            <option value="{{ $r }}" {{ request('role') == $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="md:col-span-3">
                <button type="submit" class="w-full bg-gray-800 hover:bg-gray-900 text-white font-semibold py-3 px-6 rounded-xl shadow-lg shadow-gray-200 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                    <i class="fas fa-sliders-h mr-2"></i> Terapkan Filter
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
                        <th class="px-6 py-4">User Details</th>
                        <th class="px-6 py-4">Contact Info</th>
                        <th class="px-6 py-4 text-center">Role</th>
                        <th class="px-6 py-4">Bergabung</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors duration-150 group">
                            <td class="px-6 py-4 bg-white group-hover:bg-gray-50">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-12 h-12 relative">
                                        <img class="w-full h-full rounded-full object-cover border-2 border-white shadow-md group-hover:scale-105 transition-transform duration-200" 
                                             src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=EBF4FF&color=3B82F6&font-size=0.4" 
                                             alt="{{ $user->name }}" 
                                        />
                                        <span class="absolute bottom-0 right-0 block h-3 w-3 rounded-full ring-2 ring-white {{ $user->role === 'admin' ? 'bg-green-400' : 'bg-gray-300' }}"></span>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-bold text-gray-900">{{ $user->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 bg-white group-hover:bg-gray-50">
                                <p class="text-sm font-medium text-gray-700 flex items-center">
                                    <i class="far fa-envelope text-gray-400 mr-2 w-4"></i>
                                    {{ $user->email }}
                                </p>
                                @if($user->phone)
                                    <p class="text-xs text-gray-500 mt-1 flex items-center">
                                        <i class="fas fa-phone-alt text-gray-400 mr-2 w-4"></i>
                                        {{ $user->phone }}
                                    </p>
                                @endif
                            </td>
                            <td class="px-6 py-4 bg-white group-hover:bg-gray-50 text-center">
                                @php
                                    $roleStyles = match($user->role) {
                                        'admin' => 'bg-red-100 text-red-700 border border-red-200',
                                        'manager' => 'bg-blue-100 text-blue-700 border border-blue-200',
                                        default => 'bg-emerald-100 text-emerald-700 border border-emerald-200',
                                    };
                                    $roleIcon = match($user->role) {
                                        'admin' => 'fas fa-shield-alt',
                                        'manager' => 'fas fa-briefcase',
                                        default => 'fas fa-user',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $roleStyles }}">
                                    <i class="{{ $roleIcon }} mr-1.5 text-[10px]"></i>
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 bg-white group-hover:bg-gray-50">
                                <div class="text-sm text-gray-600 font-medium">{{ $user->created_at->format('d M Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 bg-white group-hover:bg-gray-50 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="group/btn relative">
                                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center transition-all hover:bg-blue-600 hover:text-white shadow-sm hover:shadow-blue-200">
                                            <i class="fas fa-pen text-xs"></i>
                                        </div>
                                    </a>
                                    
                                    @if(auth()->id() !== $user->id)
                                        <button 
                                            onclick="confirmDelete('{{ $user->id }}', '{{ $user->name }}')" 
                                            class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center transition-all hover:bg-red-600 hover:text-white shadow-sm hover:shadow-red-200"
                                        >
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-100 rounded-full p-6 mb-4">
                                        <i class="fas fa-users-slash text-4xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900">Tidak ada pengguna ditemukan</h3>
                                    <p class="text-gray-500 mt-1 max-w-sm">Coba sesuaikan filter pencarian Anda atau tambahkan pengguna baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Custom Pagination -->
        @if($users->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex flex-col xs:flex-row items-center xs:justify-between">
            <div class="text-sm text-gray-500 mb-2 xs:mb-0">
                Menampilkan <span class="font-semibold">{{ $users->firstItem() ?? 0 }}</span> sampai <span class="font-semibold">{{ $users->lastItem() ?? 0 }}</span> dari <span class="font-semibold">{{ $users->total() }}</span> pengguna
            </div>
            <div class="inline-flex rounded-md shadow-sm">
               {{ $users->onEachSide(1)->links('pagination::tailwind') }}
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
                        Hapus Pengguna?
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            Apakah Anda yakin ingin menghapus pengguna <strong id="deleteUserName" class="text-gray-900"></strong>? <br>
                            <span class="text-red-500 text-xs mt-1 block">Tindakan ini bersifat permanen dan tidak dapat dibatalkan.</span>
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
        document.getElementById('deleteUserName').textContent = name;
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
