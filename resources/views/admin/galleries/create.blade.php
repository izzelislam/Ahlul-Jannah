@extends('layouts.admin')

@section('title', 'Tambah Galeri Baru')

@section('content')
<div class="w-full">
    <x-admin.page-header 
        title="Tambah Galeri Baru" 
        description="Upload foto atau video untuk galeri."
        icon="fas fa-plus-circle"
        back-route="{{ route('admin.galleries.index') }}"
        back-label="Kembali"
        gradient="from-purple-600 to-pink-600"
    />

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <p class="text-gray-500">Upload foto atau video untuk galeri.</p>
        </div>
        
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <x-ui.input 
                    label="Judul Galeri" 
                    id="title" 
                    name="title" 
                    value="{{ old('title') }}" 
                    required 
                    placeholder="Contoh: Kegiatan Maulid Nabi 2023"
                />
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Type -->
            <div>
                <x-ui.select label="Tipe Galeri" id="type" name="type" required>
                    <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Foto (Image)</option>
                    <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                </x-ui.select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- File Upload -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">File Upload</label>
                <!-- Hidden Input for file selection -->
                <input id="file-upload" name="file" type="file" class="hidden" accept="image/*,video/*" onchange="previewFile()" required>

                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-purple-500 transition-all cursor-pointer relative bg-gray-50 group" 
                     id="dropzone" 
                     onclick="document.getElementById('file-upload').click()">
                    
                    <div class="space-y-1 text-center" id="upload-prompt">
                        <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-cloud-upload-alt text-3xl"></i>
                        </div>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <span class="relative cursor-pointer bg-transparent rounded-md font-medium text-purple-600 hover:text-purple-500">
                                Klik untuk upload
                            </span>
                            <p class="pl-1">atau drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            PNG, JPG, MP4 hingga 20MB
                        </p>
                    </div>

                    <!-- Preview Container -->
                    <div id="preview-container" class="hidden w-full flex flex-col items-center">
                        <div class="relative w-full max-w-lg rounded-lg overflow-hidden shadow-md">
                            <img id="image-preview" class="w-full h-auto max-h-[400px] object-contain hidden" alt="Preview">
                            <video id="video-preview" class="w-full h-auto max-h-[400px] hidden" controls></video>
                            
                            <button type="button" onclick="event.stopPropagation(); resetFile();" class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-2 hover:bg-red-700 shadow-lg transition-transform hover:scale-110" title="Hapus File">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <p id="filename-display" class="mt-2 text-sm font-medium text-gray-700"></p>
                    </div>
                </div>
                @error('file')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.galleries.index') }}">
                    <x-ui.button variant="secondary" type="button">
                        Batal
                    </x-ui.button>
                </a>
                <x-ui.button variant="primary" type="submit" class="bg-purple-600 hover:bg-purple-700">
                    <i class="fas fa-save mr-2"></i> Simpan Galeri
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
        const videoPreview = document.getElementById('video-preview');
        const filenameDisplay = document.getElementById('filename-display');
        const dropzone = document.getElementById('dropzone');

        if (file) {
            // Show preview container
            uploadPrompt.classList.add('hidden');
            previewContainer.classList.remove('hidden');
            dropzone.classList.remove('border-dashed');
            dropzone.classList.add('border-solid', 'border-purple-200', 'bg-white');
            
            filenameDisplay.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';

            if (file.type.startsWith('image/')) {
                videoPreview.classList.add('hidden');
                videoPreview.src = ""; // Stop video if any
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else if (file.type.startsWith('video/')) {
                imagePreview.classList.add('hidden');
                imagePreview.src = "";
                
                const url = URL.createObjectURL(file);
                videoPreview.src = url;
                videoPreview.classList.remove('hidden');
            }
        }
    }

    function resetFile() {
        const input = document.getElementById('file-upload');
        input.value = ''; // Reset input
        
        const uploadPrompt = document.getElementById('upload-prompt');
        const previewContainer = document.getElementById('preview-container');
        const dropzone = document.getElementById('dropzone');
        
        uploadPrompt.classList.remove('hidden');
        previewContainer.classList.add('hidden');
        dropzone.classList.add('border-dashed');
        dropzone.classList.remove('border-solid', 'border-purple-200', 'bg-white');
    }
</script>
@endsection
