@extends('layouts.admin')

@section('title', 'Edit Galeri')

@section('content')
<div class="w-full">
    <x-admin.page-header 
        title="Edit Galeri" 
        description="Perbarui informasi galeri"
        icon="fas fa-edit"
        back-route="{{ route('admin.galleries.index') }}"
        back-label="Kembali"
        gradient="from-purple-600 to-pink-600"
    />

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-100">
           <p class="text-gray-500">Edit informasi galeri: <strong>{{ $gallery->title }}</strong></p>
        </div>
        
        <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <x-ui.input 
                    label="Judul Galeri" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $gallery->title) }}" 
                    required 
                />
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Type -->
            <div>
                <x-ui.select label="Tipe Galeri" id="type" name="type" required>
                    <option value="image" {{ old('type', $gallery->type) == 'image' ? 'selected' : '' }}>Foto (Image)</option>
                    <option value="video" {{ old('type', $gallery->type) == 'video' ? 'selected' : '' }}>Video</option>
                </x-ui.select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- File Upload with Preview -->
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">File Galeri</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Current File Display -->
                    <div class="space-y-2">
                         <p class="text-sm text-gray-600 font-semibold">File Saat Ini:</p>
                         <div class="rounded-lg overflow-hidden border border-gray-200 bg-gray-50 relative h-64">
                            @if($gallery->type == 'image')
                                <img src="{{ Storage::url($gallery->file_path) }}" alt="Current" class="w-full h-full object-contain">
                            @else
                                <video class="w-full h-full object-contain" controls>
                                    <source src="{{ Storage::url($gallery->file_path) }}" type="video/mp4">
                                    Browser anda tidak mendukung tag video.
                                </video>
                            @endif
                        </div>
                    </div>

                    <!-- New File Upload -->
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600 font-semibold">Ganti File (Opsional):</p>
                        
                         <input id="file-upload" name="file" type="file" class="hidden" accept="image/*,video/*" onchange="previewFile()">

                        <div class="h-64 flex flex-col justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-purple-500 transition-all cursor-pointer relative bg-white group" 
                             id="dropzone" 
                             onclick="document.getElementById('file-upload').click()">
                            
                            <div class="space-y-1 text-center" id="upload-prompt">
                                <i class="fas fa-exchange-alt text-3xl text-gray-400 group-hover:text-purple-500 mb-3 transition-colors"></i>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <span class="relative cursor-pointer bg-transparent rounded-md font-medium text-purple-600 hover:text-purple-500">
                                        Klik untuk ganti file
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">
                                    Biarkan kosong jika tidak ingin mengubah
                                </p>
                            </div>

                            <!-- Preview Container -->
                            <div id="preview-container" class="hidden absolute inset-0 w-full h-full bg-white z-10 flex-col items-center justify-center p-2">
                                <div class="relative w-full h-full rounded overflow-hidden">
                                    <img id="image-preview" class="w-full h-full object-contain hidden" alt="Preview">
                                    <video id="video-preview" class="w-full h-full object-contain hidden" controls></video>
                                    
                                    <button type="button" onclick="event.stopPropagation(); resetFile();" class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-2 hover:bg-red-700 shadow-lg" title="Batalkan Ganti File">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                         @error('file')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.galleries.index') }}">
                    <x-ui.button variant="secondary" type="button">
                        Batal
                    </x-ui.button>
                </a>
                <x-ui.button variant="primary" type="submit" class="bg-purple-600 hover:bg-purple-700">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
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
        const dropzone = document.getElementById('dropzone');

        if (file) {
            // Show preview container
            uploadPrompt.classList.add('hidden');
            previewContainer.classList.remove('hidden');
            previewContainer.classList.add('flex');
            dropzone.classList.remove('border-dashed');
            dropzone.classList.add('border-solid', 'border-purple-200');

            if (file.type.startsWith('image/')) {
                videoPreview.classList.add('hidden');
                videoPreview.src = ""; 
                
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
        previewContainer.classList.remove('flex');
        dropzone.classList.add('border-dashed');
        dropzone.classList.remove('border-solid', 'border-purple-200');
    }
</script>
@endsection
