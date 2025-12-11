@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
<div class="w-full">
    <x-admin.page-header 
        title="Edit Post" 
        description="Perbarui konten artikel."
        icon="fas fa-edit"
        back-route="{{ route('admin.posts.index') }}"
        back-label="Kembali"
    />

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6" id="postForm">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Title -->
                    <div>
                        <x-ui.input 
                            label="Judul Artikel" 
                            id="title" 
                            name="title" 
                            value="{{ old('title', $post->title) }}" 
                            required 
                        />
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content (Quill) -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Konten Artikel</label>
                        <div id="editor-container" class="h-96 bg-gray-50 rounded-lg"></div>
                        <input type="hidden" name="content" id="content" value="{{ old('content', $post->content) }}">
                        @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column: Meta & Sidebar -->
                <div class="space-y-6">
                    <!-- Category -->
                    <div>
                        <x-ui.select label="Kategori" id="category_id" name="category_id" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </x-ui.select>
                        @error('category_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <label class="flex items-center cursor-pointer">
                            <div class="relative">
                                <input type="checkbox" name="is_published" value="1" id="is_published" class="sr-only" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                                <div class="block bg-gray-200 w-14 h-8 rounded-full transition-colors" id="toggle-bg"></div>
                                <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition-transform" id="toggle-dot"></div>
                            </div>
                            <div class="ml-3 text-gray-700 font-medium" id="status-label">
                                {{ $post->is_published ? 'Published' : 'Draft' }}
                            </div>
                        </label>
                        <p class="text-xs text-gray-400 mt-2">Status saat ini.</p>
                    </div>

                    <!-- Thumbnail -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Thumbnail</label>
                        
                        <!-- Current Image -->
                        @if($post->thumbnail)
                            <div class="mb-4 relative group">
                                <p class="text-xs text-gray-500 mb-1">Gambar Saat Ini:</p>
                                <img src="{{ Storage::url($post->thumbnail) }}" alt="Current Thumbnail" class="w-full h-auto rounded-lg shadow-sm border border-gray-200">
                            </div>
                        @endif

                        <!-- Upload New -->
                         <input id="file-upload" name="thumbnail" type="file" class="hidden" accept="image/*" onchange="previewFile()">

                        <div class="flex flex-col justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-500 transition-all cursor-pointer relative bg-gray-50 group" 
                             id="dropzone" 
                             onclick="document.getElementById('file-upload').click()">
                            
                            <div class="space-y-1 text-center" id="upload-prompt">
                                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-camera text-xl"></i>
                                </div>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <span class="relative cursor-pointer bg-transparent rounded-md font-medium text-blue-600 hover:text-blue-500">
                                        Ganti Gambar
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500">Biarkan kosong jika tidak berubah</p>
                            </div>

                            <!-- Preview New Container -->
                            <div id="preview-container" class="hidden w-full flex flex-col items-center">
                                <p class="text-xs text-green-600 font-bold mb-1 w-full text-left">Preview Baru:</p>
                                <img id="image-preview" class="w-full h-40 object-cover rounded-md shadow-sm mb-2" alt="Preview">
                                <button type="button" onclick="event.stopPropagation(); resetFile();" class="text-xs text-red-500 hover:text-red-700 font-medium z-10">
                                    <i class="fas fa-times mr-1"></i> Batalkan Ganti
                                </button>
                            </div>
                        </div>
                        @error('thumbnail')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.posts.index') }}">
                    <x-ui.button variant="secondary" type="button">
                        Batal
                    </x-ui.button>
                </a>
                <x-ui.button variant="primary" type="submit">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </x-ui.button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    /* Toggle Switch Custom CSS */
    input:checked ~ #toggle-bg {
        background-color: #10B981; /* emerald-500 */
    }
    input:checked ~ #toggle-dot {
        transform: translateX(100%);
    }
    .ql-container {
        border-bottom-left-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
        background: white;
    }
    .ql-toolbar {
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
        background: #f9fafb;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    // Quill Init
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Tulis konten artikel di sini...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'blockquote', 'code-block'],
                [{ 'color': [] }, { 'background': [] }],
                ['clean']
            ]
        }
    });

    // Populate hidden input
    var contentInput = document.querySelector('input[name=content]');
    // Init Quill with existing content
    if(contentInput.value) {
        quill.root.innerHTML = contentInput.value;
    }

    // Sync on submit
    var form = document.getElementById('postForm');
    form.onsubmit = function() {
        contentInput.value = quill.root.innerHTML;
    };

    // Toggle Status Label
    const statusCheckbox = document.getElementById('is_published');
    const statusLabel = document.getElementById('status-label');
    
    function updateStatusLabel() {
        if(statusCheckbox.checked) {
            statusLabel.textContent = 'Published';
            statusLabel.classList.add('text-green-600');
            statusLabel.classList.remove('text-gray-700');
        } else {
            statusLabel.textContent = 'Draft';
            statusLabel.classList.add('text-gray-700');
            statusLabel.classList.remove('text-green-600');
        }
    }
    statusCheckbox.addEventListener('change', updateStatusLabel);
    
    // File Preview Logic
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
@endpush
@endsection
