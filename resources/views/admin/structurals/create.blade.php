@extends('layouts.admin')

@section('title', 'Tambah Anggota Struktural')

@section('content')
<div class="w-full">
    <x-admin.page-header 
        title="Tambah Anggota" 
        description="Tambahkan anggota baru ke struktur organisasi."
        icon="fas fa-user-plus"
        back-route="{{ route('admin.structurals.index') }}"
        back-label="Kembali"
    />

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <form action="{{ route('admin.structurals.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama -->
                <div>
                    <x-ui.input 
                        label="Nama Lengkap" 
                        id="nama" 
                        name="nama" 
                        value="{{ old('nama') }}" 
                        required 
                        placeholder="Contoh: H. Ahmad Fauzi, S.Pd"
                    />
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jabatan -->
                <div>
                    <x-ui.input 
                        label="Jabatan" 
                        id="jabatan" 
                        name="jabatan" 
                        value="{{ old('jabatan') }}" 
                        required 
                        placeholder="Contoh: Kepala Sekolah"
                    />
                    @error('jabatan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Urutan -->
            <div class="w-full md:w-1/2">
                <x-ui.input 
                    label="Urutan Tampil" 
                    id="urutan" 
                    name="urutan" 
                    type="number"
                    value="{{ old('urutan', 0) }}" 
                    required 
                    placeholder="0"
                />
                <p class="text-xs text-gray-400 mt-1">Semakin kecil angkanya, semakin di awal posisinya (0, 1, 2, ...)</p>
                @error('urutan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Foto Upload -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Foto Profil</label>
                 <input id="file-upload" name="foto" type="file" class="hidden" accept="image/*" onchange="previewFile()">

                <div class="flex flex-col justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-500 transition-all cursor-pointer relative bg-gray-50 group" 
                     id="dropzone" 
                     onclick="document.getElementById('file-upload').click()">
                    
                    <div class="space-y-1 text-center" id="upload-prompt">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                            <i class="fas fa-camera text-xl"></i>
                        </div>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <span class="relative cursor-pointer bg-transparent rounded-md font-medium text-blue-600 hover:text-blue-500">
                                Upload Foto
                            </span>
                        </div>
                        <p class="text-xs text-gray-500">Format: JPG, PNG. Max: 2MB</p>
                    </div>

                    <!-- Preview Container -->
                    <div id="preview-container" class="hidden w-full flex flex-col items-center">
                        <img id="image-preview" class="w-32 h-32 object-cover rounded-full shadow-md mb-2 border-4 border-white" alt="Preview">
                        <button type="button" onclick="event.stopPropagation(); resetFile();" class="text-xs text-red-500 hover:text-red-700 font-medium z-10">
                            <i class="fas fa-times mr-1"></i> Ganti Foto
                        </button>
                    </div>
                </div>
                @error('foto')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.structurals.index') }}">
                    <x-ui.button variant="secondary" type="button">
                        Batal
                    </x-ui.button>
                </a>
                <x-ui.button variant="primary" type="submit">
                    <i class="fas fa-save mr-2"></i> Simpan Data
                </x-ui.button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewFile() {
        const input = document.getElementById('file-upload');
        const file = input.files[0];
        const uploadPrompt = document.getElementById('upload-prompt');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');
        const dropzone = document.getElementById('dropzone');

        if (file) {
            uploadPrompt.classList.add('hidden');
            previewContainer.classList.remove('hidden');
            dropzone.classList.remove('border-dashed');
            dropzone.classList.add('border-solid', 'border-blue-200', 'bg-white');
            
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }

    function resetFile() {
        const input = document.getElementById('file-upload');
        input.value = ''; 
        
        const uploadPrompt = document.getElementById('upload-prompt');
        const previewContainer = document.getElementById('preview-container');
        const dropzone = document.getElementById('dropzone');
        
        uploadPrompt.classList.remove('hidden');
        previewContainer.classList.add('hidden');
        dropzone.classList.add('border-dashed');
        dropzone.classList.remove('border-solid', 'border-blue-200', 'bg-white');
    }
</script>
@endsection
