@extends('layouts.admin')

@section('title', 'Edit Halaman: ' . $page->title)

@section('content')
<div class="max-w-full mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Halaman: {{ $page->title }}</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola konten halaman website Anda</p>
        </div>
        <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    @if($page->slug == 'home')
        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="title" value="{{ $page->title }}">
            <input type="hidden" name="is_published" value="1">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Main Sections -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Hero Section Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-primary-500 to-primary-600 px-6 py-4">
                            <h3 class="text-lg font-bold text-white flex items-center">
                                <i class="fas fa-home mr-3"></i> Hero Section
                            </h3>
                            <p class="text-primary-100 text-sm mt-1">Bagian utama yang pertama dilihat pengunjung</p>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Badge Text</label>
                                <input type="text" name="content[hero][badge]" value="{{ $page->content['hero']['badge'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Contoh: Penerimaan Santri Baru">
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Baris 1</label>
                                    <input type="text" name="content[hero][title_1]" value="{{ $page->content['hero']['title_1'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Baris 2 <span class="text-xs text-gray-500">(Highlight)</span></label>
                                    <input type="text" name="content[hero][title_2]" value="{{ $page->content['hero']['title_2'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
                                <textarea name="content[hero][description]" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">{{ $page->content['hero']['description'] ?? '' }}</textarea>
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tombol 1 - Text</label>
                                    <input type="text" name="content[hero][button1_text]" value="{{ $page->content['hero']['button1_text'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tombol 1 - URL</label>
                                    <input type="text" name="content[hero][button1_url]" value="{{ $page->content['hero']['button1_url'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                                </div>
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tombol 2 - Text</label>
                                    <input type="text" name="content[hero][button2_text]" value="{{ $page->content['hero']['button2_text'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tombol 2 - URL</label>
                                    <input type="text" name="content[hero][button2_url]" value="{{ $page->content['hero][button2_url'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Gambar Hero</label>
                                @if(!empty($page->content['hero']['image']))
                                    <div class="mb-3 relative inline-block">
                                        <img src="{{ Str::startsWith($page->content['hero']['image'], 'http') ? $page->content['hero']['image'] : Storage::url($page->content['hero']['image']) }}" alt="Hero Preview" class="h-40 w-auto object-cover rounded-lg shadow-md border-2 border-slate-200">
                                        <div class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full">Current</div>
                                    </div>
                                @endif
                                <input type="file" name="content[hero][image]" accept="image/*" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                                <p class="text-xs text-slate-500 mt-2">Kosongkan jika tidak ingin mengubah gambar</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Fitur Unggulan</label>
                                @if(isset($page->content['hero']['features']) && is_array($page->content['hero']['features']))
                                    @foreach($page->content['hero']['features'] as $key => $feature)
                                        <div class="flex items-center gap-2 mb-2">
                                            <i class="fas fa-check-circle text-primary-500"></i>
                                            <input type="text" name="content[hero][features][]" value="{{ $feature }}" class="flex-1 px-4 py-2 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Fitur">
                                        </div>
                                    @endforeach
                                @endif
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-plus-circle text-gray-400"></i>
                                    <input type="text" name="content[hero][features][]" class="flex-1 px-4 py-2 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Tambah fitur baru">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- About Section Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                            <h3 class="text-lg font-bold text-white flex items-center">
                                <i class="fas fa-info-circle mr-3"></i> About Section
                            </h3>
                            <p class="text-blue-100 text-sm mt-1">Informasi tentang organisasi</p>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Subtitle</label>
                                <input type="text" name="content[about][subtitle]" value="{{ $page->content['about']['subtitle'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Judul</label>
                                <input type="text" name="content[about][title]" value="{{ $page->content['about']['title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
                                <textarea name="content[about][description]" rows="4" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">{{ $page->content['about']['description'] ?? '' }}</textarea>
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Gambar 1</label>
                                    @if(!empty($page->content['about']['image_1']))
                                        <div class="mb-2">
                                            <img src="{{ Str::startsWith($page->content['about']['image_1'], 'http') ? $page->content['about']['image_1'] : Storage::url($page->content['about']['image_1']) }}" alt="Preview" class="h-32 w-full object-cover rounded-lg shadow-sm border border-slate-200">
                                        </div>
                                    @endif
                                    <input type="file" name="content[about][image_1]" accept="image/*" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Gambar 2</label>
                                    @if(!empty($page->content['about']['image_2']))
                                        <div class="mb-2">
                                            <img src="{{ Str::startsWith($page->content['about']['image_2'], 'http') ? $page->content['about']['image_2'] : Storage::url($page->content['about']['image_2']) }}" alt="Preview" class="h-32 w-full object-cover rounded-lg shadow-sm border border-slate-200">
                                        </div>
                                    @endif
                                    <input type="file" name="content[about][image_2]" accept="image/*" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                                </div>
                            </div>
                            
                            <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                                <h4 class="font-semibold text-sm text-slate-700 mb-3 flex items-center">
                                    <i class="fas fa-list-ul mr-2 text-primary-500"></i> Daftar Fitur
                                </h4>
                                @if(isset($page->content['about']['features']) && is_array($page->content['about']['features']))
                                    @foreach($page->content['about']['features'] as $key => $feature)
                                        <div class="grid grid-cols-2 gap-3 mb-3 p-3 bg-white rounded-lg border border-slate-200">
                                            <div>
                                                <label class="block text-xs font-semibold text-slate-500 mb-1">Judul Fitur</label>
                                                <input type="text" name="content[about][features][{{ $key }}][title]" value="{{ $feature['title'] ?? '' }}" class="w-full px-3 py-2 rounded border border-slate-300 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-semibold text-slate-500 mb-1">Deskripsi</label>
                                                <input type="text" name="content[about][features][{{ $key }}][description]" value="{{ $feature['description'] ?? '' }}" class="w-full px-3 py-2 rounded border border-slate-300 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Video Section Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                            <h3 class="text-lg font-bold text-white flex items-center">
                                <i class="fas fa-video mr-3"></i> Video Section
                            </h3>
                            <p class="text-red-100 text-sm mt-1">Video profil dan statistik</p>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Section</label>
                                <input type="text" name="content[video][title]" value="{{ $page->content['video']['title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">YouTube Embed URL</label>
                                <input type="text" name="content[video][youtube_url]" value="{{ $page->content['video']['youtube_url'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="https://www.youtube.com/embed/...">
                            </div>
                            
                            <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                                <h4 class="font-semibold text-sm text-slate-700 mb-3 flex items-center">
                                    <i class="fas fa-chart-bar mr-2 text-red-500"></i> Statistik
                                </h4>
                                @if(isset($page->content['video']['stats']) && is_array($page->content['video']['stats']))
                                    <div class="grid grid-cols-2 gap-3">
                                        @foreach($page->content['video']['stats'] as $key => $stat)
                                            <div class="bg-white p-3 rounded-lg border border-slate-200">
                                                <input type="text" name="content[video][stats][{{ $key }}][count]" value="{{ $stat['count'] ?? '' }}" class="w-full px-3 py-2 rounded border border-slate-300 text-sm font-bold text-center focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition mb-2" placeholder="100+">
                                                <input type="text" name="content[video][stats][{{ $key }}][label]" value="{{ $stat['label'] ?? '' }}" class="w-full px-3 py-2 rounded border border-slate-300 text-sm text-center focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Label">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Secondary Sections -->
                <div class="space-y-6">
                    
                    <!-- Instagram Section Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-pink-500 to-purple-600 px-6 py-4">
                            <h3 class="text-lg font-bold text-white flex items-center">
                                <i class="fab fa-instagram mr-3"></i> Instagram
                            </h3>
                            <p class="text-pink-100 text-sm mt-1">Integrasi sosial media</p>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Subtitle</label>
                                <input type="text" name="content[instagram][subtitle]" value="{{ $page->content['instagram']['subtitle'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Judul</label>
                                <input type="text" name="content[instagram][title]" value="{{ $page->content['instagram']['title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
                                <textarea name="content[instagram][description]" rows="2" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">{{ $page->content['instagram']['description'] ?? '' }}</textarea>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Link Text</label>
                                <input type="text" name="content[instagram][link_text]" value="{{ $page->content['instagram']['link_text'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Link URL</label>
                                <input type="text" name="content[instagram][link_url]" value="{{ $page->content['instagram']['link_url'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                        </div>
                    </div>

                    <!-- CTA Section Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                            <h3 class="text-lg font-bold text-white flex items-center">
                                <i class="fas fa-bullhorn mr-3"></i> Call to Action
                            </h3>
                            <p class="text-green-100 text-sm mt-1">Ajakan untuk pengunjung</p>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Judul CTA</label>
                                <input type="text" name="content[cta][title]" value="{{ $page->content['cta']['title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
                                <textarea name="content[cta][description]" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">{{ $page->content['cta']['description'] ?? '' }}</textarea>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Tombol 1 - Text</label>
                                <input type="text" name="content[cta][button1_text]" value="{{ $page->content['cta']['button1_text'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Tombol 1 - URL</label>
                                <input type="text" name="content[cta][button1_url]" value="{{ $page->content['cta']['button1_url'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Tombol 2 - Text</label>
                                <input type="text" name="content[cta][button2_text]" value="{{ $page->content['cta']['button2_text'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Tombol 2 - URL</label>
                                <input type="text" name="content[cta][button2_url]" value="{{ $page->content['cta']['button2_url'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-lg shadow-md border border-gray-200 mt-8 p-6">
                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('admin.pages.index') }}">
                        <x-ui.button variant="secondary" type="button">
                            Batal
                        </x-ui.button>
                    </a>
                    <x-ui.button variant="primary" type="submit">
                        <i class="fas fa-save mr-2"></i>
                        Update Profil
                    </x-ui.button>
                </div>
            </div>
        </form>
    @elseif($page->slug == 'profil')
        <!-- Profil Page Edit Form -->
        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="title" value="{{ $page->title }}">
            <input type="hidden" name="is_published" value="1">
            
            <div class="space-y-6">
                <!-- Hero Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-image mr-3"></i> Hero Section
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Subtitle</label>
                                <input type="text" name="content[hero][subtitle]" value="{{ $page->content['hero']['subtitle'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Title</label>
                                <input type="text" name="content[hero][title]" value="{{ $page->content['hero']['title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                            <textarea name="content[hero][description]" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">{{ $page->content['hero']['description'] ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Hero Image URL</label>
                            <input type="text" name="content[hero][image]" value="{{ $page->content['hero']['image'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                        </div>
                    </div>
                </div>

                <!-- Sejarah Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-history mr-3"></i> Sejarah
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Title</label>
                            <input type="text" name="content[sejarah][title]" value="{{ $page->content['sejarah']['title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Content</label>
                            <textarea name="content[sejarah][content]" rows="4" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">{{ $page->content['sejarah']['content'] ?? '' }}</textarea>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Tahun Berdiri</label>
                                <input type="text" name="content[sejarah][year_founded]" value="{{ $page->content['sejarah']['year_founded'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Pendiri</label>
                                <input type="text" name="content[sejarah][founder]" value="{{ $page->content['sejarah']['founder'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visi Misi Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-bullseye mr-3"></i> Visi & Misi
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Visi</label>
                            <textarea name="content[visi_misi][visi]" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">{{ $page->content['visi_misi']['visi'] ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Misi (satu per baris)</label>
                            @if(isset($page->content['visi_misi']['misi']) && is_array($page->content['visi_misi']['misi']))
                                @foreach($page->content['visi_misi']['misi'] as $key => $misi)
                                    <input type="text" name="content[visi_misi][misi][]" value="{{ $misi }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition mb-2">
                                @endforeach
                            @endif
                            <input type="text" name="content[visi_misi][misi][]" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Tambah misi baru">
                        </div>
                    </div>
                </div>

                <!-- Statistik Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-chart-bar mr-3"></i> Statistik
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid md:grid-cols-2 gap-4">
                            @if(isset($page->content['statistik']) && is_array($page->content['statistik']))
                                @foreach($page->content['statistik'] as $key => $stat)
                                    <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                                        <input type="text" name="content[statistik][{{ $key }}][count]" value="{{ $stat['count'] ?? '' }}" class="w-full px-3 py-2 rounded border border-slate-300 text-sm font-bold mb-2" placeholder="100+">
                                        <input type="text" name="content[statistik][{{ $key }}][label]" value="{{ $stat['label'] ?? '' }}" class="w-full px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Label">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Prestasi Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-trophy mr-3"></i> Prestasi
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Title</label>
                            <input type="text" name="content[prestasi][title]" value="{{ $page->content['prestasi']['title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Daftar Prestasi</label>
                            @if(isset($page->content['prestasi']['items']) && is_array($page->content['prestasi']['items']))
                                @foreach($page->content['prestasi']['items'] as $prestasi)
                                    <input type="text" name="content[prestasi][items][]" value="{{ $prestasi }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition mb-2">
                                @endforeach
                            @endif
                            <input type="text" name="content[prestasi][items][]" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Tambah prestasi baru">
                        </div>
                    </div>
                </div>

                <!-- Fasilitas Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-teal-500 to-teal-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-building mr-3"></i> Fasilitas
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Title</label>
                            <input type="text" name="content[fasilitas][title]" value="{{ $page->content['fasilitas']['title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                        </div>
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Daftar Fasilitas</label>
                            @if(isset($page->content['fasilitas']['items']) && is_array($page->content['fasilitas']['items']))
                                @foreach($page->content['fasilitas']['items'] as $key => $fasilitas)
                                    <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                                        <div class="grid md:grid-cols-3 gap-3">
                                            <input type="text" name="content[fasilitas][items][{{ $key }}][name]" value="{{ $fasilitas['name'] ?? '' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Nama Fasilitas">
                                            <input type="text" name="content[fasilitas][items][{{ $key }}][icon]" value="{{ $fasilitas['icon'] ?? '' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="fa-home">
                                            <input type="text" name="content[fasilitas][items][{{ $key }}][description]" value="{{ $fasilitas['description'] ?? '' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Deskripsi">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-lg shadow-md border border-gray-200 mt-8 p-6">
                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('admin.pages.index') }}">
                        <x-ui.button variant="secondary" type="button">
                            Batal
                        </x-ui.button>
                    </a>
                    <x-ui.button variant="primary" type="submit">
                        <i class="fas fa-save mr-2"></i>
                        Update Profil
                    </x-ui.button>
                </div>
            </div>
        </form>
    @elseif($page->slug == 'kontak')
        <!-- Kontak Page Edit Form -->
        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="title" value="{{ $page->title }}">
            <input type="hidden" name="is_published" value="1">
            
            <div class="space-y-6">
                <!-- Hero Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-heading mr-3"></i> Hero Section
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Subtitle</label>
                                <input type="text" name="content[hero][subtitle]" value="{{ $page->content['hero']['subtitle'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Title</label>
                                <input type="text" name="content[hero][title]" value="{{ $page->content['hero']['title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                            <textarea name="content[hero][description]" rows="2" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">{{ $page->content['hero']['description'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Contact Info Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-address-book mr-3"></i> Informasi Kontak
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Alamat -->
                        <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                            <h4 class="font-semibold text-sm text-slate-700 mb-3">Alamat</h4>
                            <div class="grid md:grid-cols-3 gap-3">
                                <input type="text" name="content[contact_info][alamat][label]" value="{{ $page->content['contact_info']['alamat']['label'] ?? 'Alamat' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Label">
                                <input type="text" name="content[contact_info][alamat][icon]" value="{{ $page->content['contact_info']['alamat']['icon'] ?? 'fa-map-marker-alt' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Icon">
                                <input type="text" name="content[contact_info][alamat][value]" value="{{ $page->content['contact_info']['alamat']['value'] ?? '' }}" class="px-3 py-2 rounded border border-slate-300 text-sm md:col-span-3" placeholder="Alamat lengkap">
                            </div>
                        </div>

                        <!-- Telepon -->
                        <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                            <h4 class="font-semibold text-sm text-slate-700 mb-3">Telepon</h4>
                            <div class="grid md:grid-cols-3 gap-3">
                                <input type="text" name="content[contact_info][telepon][label]" value="{{ $page->content['contact_info']['telepon']['label'] ?? 'Telepon' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Label">
                                <input type="text" name="content[contact_info][telepon][icon]" value="{{ $page->content['contact_info']['telepon']['icon'] ?? 'fa-phone' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Icon">
                                <input type="text" name="content[contact_info][telepon][value]" value="{{ $page->content['contact_info']['telepon']['value'] ?? '' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Nomor telepon">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                            <h4 class="font-semibold text-sm text-slate-700 mb-3">Email</h4>
                            <div class="grid md:grid-cols-3 gap-3">
                                <input type="text" name="content[contact_info][email][label]" value="{{ $page->content['contact_info']['email']['label'] ?? 'Email' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Label">
                                <input type="text" name="content[contact_info][email][icon]" value="{{ $page->content['contact_info']['email']['icon'] ?? 'fa-envelope' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Icon">
                                <input type="email" name="content[contact_info][email][value]" value="{{ $page->content['contact_info']['email']['value'] ?? '' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Email">
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                            <h4 class="font-semibold text-sm text-slate-700 mb-3">WhatsApp</h4>
                            <div class="grid md:grid-cols-2 gap-3">
                                <input type="text" name="content[contact_info][whatsapp][label]" value="{{ $page->content['contact_info']['whatsapp']['label'] ?? 'WhatsApp' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Label">
                                <input type="text" name="content[contact_info][whatsapp][icon]" value="{{ $page->content['contact_info']['whatsapp']['icon'] ?? 'fa-whatsapp' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Icon">
                                <input type="text" name="content[contact_info][whatsapp][value]" value="{{ $page->content['contact_info']['whatsapp']['value'] ?? '' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Nomor WA">
                                <input type="text" name="content[contact_info][whatsapp][link]" value="{{ $page->content['contact_info']['whatsapp']['link'] ?? '' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="https://wa.me/...">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-clock mr-3"></i> Jam Operasional
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Title</label>
                            <input type="text" name="content[jam_operasional][title]" value="{{ $page->content['jam_operasional']['title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Jadwal</label>
                            @if(isset($page->content['jam_operasional']['items']) && is_array($page->content['jam_operasional']['items']))
                                @foreach($page->content['jam_operasional']['items'] as $key => $jadwal)
                                    <div class="grid md:grid-cols-2 gap-3 bg-slate-50 p-3 rounded-lg">
                                        <input type="text" name="content[jam_operasional][items][{{ $key }}][hari]" value="{{ $jadwal['hari'] ?? '' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Hari">
                                        <input type="text" name="content[jam_operasional][items][{{ $key }}][jam]" value="{{ $jadwal['jam'] ?? '' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Jam">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-pink-500 to-purple-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-share-alt mr-3"></i> Media Sosial
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Title</label>
                            <input type="text" name="content[social_media][title]" value="{{ $page->content['social_media']['title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
                        </div>
                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Daftar Sosial Media</label>
                            @if(isset($page->content['social_media']['items']) && is_array($page->content['social_media']['items']))
                                @foreach($page->content['social_media']['items'] as $key => $social)
                                    <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                                        <div class="grid md:grid-cols-4 gap-3">
                                            <input type="text" name="content[social_media][items][{{ $key }}][name]" value="{{ $social['name'] ?? '' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="Nama">
                                            <input type="text" name="content[social_media][items][{{ $key }}][icon]" value="{{ $social['icon'] ?? '' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="fab fa-facebook">
                                            <input type="text" name="content[social_media][items][{{ $key }}][color]" value="{{ $social['color'] ?? '' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="bg-blue-600">
                                            <input type="text" name="content[social_media][items][{{ $key }}][url]" value="{{ $social['url'] ?? '' }}" class="px-3 py-2 rounded border border-slate-300 text-sm" placeholder="URL">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Maps -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-map-marked-alt mr-3"></i> Google Maps
                        </h3>
                    </div>
                    <div class="p-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Embed URL</label>
                            <textarea name="content[maps][embed_url]" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition font-mono text-xs" placeholder="https://www.google.com/maps/embed?pb=...">{{ $page->content['maps']['embed_url'] ?? '' }}</textarea>
                            <p class="text-xs text-slate-500 mt-2">Dapatkan embed URL dari Google Maps → Share → Embed a map</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-lg shadow-md border border-gray-200 mt-8 p-6">
                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('admin.pages.index') }}">
                        <x-ui.button variant="secondary" type="button">
                            Batal
                        </x-ui.button>
                    </a>
                    <x-ui.button variant="primary" type="submit">
                        <i class="fas fa-save mr-2"></i>
                        Update Kontak
                    </x-ui.button>
                </div>
            </div>
        </form>
    @elseif($page->slug == 'ppdb')
        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="title" value="{{ $page->title }}">
            <input type="hidden" name="is_published" value="1">
            
            <div class="space-y-6">
                
                <!-- Hero Section Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-star mr-3"></i> Hero Section
                        </h3>
                        <p class="text-blue-100 text-sm mt-1">Bagian utama di halaman PPDB</p>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Badge Text</label>
                            <input type="text" name="content[hero][badge]" value="{{ $page->content['hero']['badge'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Contoh: Pendaftaran Dibuka!">
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Utama</label>
                                <input type="text" name="content[hero][title]" value="{{ $page->content['hero']['title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Penerimaan Peserta Didik Baru">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Sub Judul</label>
                                <input type="text" name="content[hero][subtitle]" value="{{ $page->content['hero']['subtitle'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Tahun Ajaran 2025/2026">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
                            <textarea name="content[hero][description]" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Deskripsi singkat tentang PPDB">{{ $page->content['hero']['description'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Info Pendaftaran Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-info-circle mr-3"></i> Info Pendaftaran
                        </h3>
                        <p class="text-green-100 text-sm mt-1">Informasi periode, biaya, dan kuota</p>
                    </div>
                    <div class="p-6">
                        <div class="grid md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Periode Pendaftaran</label>
                                <input type="text" name="content[info][registration_period]" value="{{ $page->content['info']['registration_period'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="1 Januari - 30 Juni 2025">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Biaya Pendaftaran</label>
                                <input type="text" name="content[info][registration_fee]" value="{{ $page->content['info']['registration_fee'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="GRATIS">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Kuota</label>
                                <input type="text" name="content[info][quota]" value="{{ $page->content['info']['quota'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="100 Santri">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Persyaratan Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-clipboard-list mr-3"></i> Persyaratan Pendaftaran
                        </h3>
                        <p class="text-orange-100 text-sm mt-1">Syarat umum dan dokumen yang diperlukan</p>
                    </div>
                    <div class="p-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Persyaratan Umum <span class="text-xs text-gray-500">(pisahkan dengan enter)</span></label>
                                <textarea name="content[requirements][general_text]" rows="6" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Lulus SD/MI atau sederajat&#10;Usia maksimal 15 tahun&#10;Sehat jasmani dan rohani">{{ is_array($page->content['requirements']['general'] ?? []) ? implode("\n", $page->content['requirements']['general']) : '' }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Dokumen yang Diperlukan <span class="text-xs text-gray-500">(pisahkan dengan enter)</span></label>
                                <textarea name="content[requirements][documents_text]" rows="6" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Fotocopy Ijazah SD/MI&#10;Fotocopy Akta Kelahiran&#10;Fotocopy Kartu Keluarga">{{ is_array($page->content['requirements']['documents'] ?? []) ? implode("\n", $page->content['requirements']['documents']) : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Alur Pendaftaran Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-route mr-3"></i> Alur Pendaftaran
                        </h3>
                        <p class="text-purple-100 text-sm mt-1">Langkah-langkah proses pendaftaran</p>
                    </div>
                    <div class="p-6 space-y-4">
                        @for($i = 0; $i < 4; $i++)
                        <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-lg">
                            <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">
                                {{ $i + 1 }}
                            </div>
                            <div class="flex-1 grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-600 mb-1">Judul Langkah {{ $i + 1 }}</label>
                                    <input type="text" name="content[flow][{{ $i }}][title]" value="{{ $page->content['flow'][$i]['title'] ?? '' }}" class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-600 mb-1">Deskripsi</label>
                                    <input type="text" name="content[flow][{{ $i }}][description]" value="{{ $page->content['flow'][$i]['description'] ?? '' }}" class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-sm">
                                    <input type="hidden" name="content[flow][{{ $i }}][step]" value="{{ $i + 1 }}">
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
                
                <!-- Brosur Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-file-pdf mr-3"></i> Brosur & Kontak
                        </h3>
                        <p class="text-slate-300 text-sm mt-1">Gambar brosur dan kontak PPDB</p>
                    </div>
                    <div class="p-6">
                        <!-- Brochure Image Upload -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Gambar Brosur</label>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <div class="border-2 border-dashed border-slate-300 rounded-lg p-4 text-center hover:border-primary-500 transition-colors">
                                        <input type="file" name="content[brochure][image]" id="brochure_image" accept="image/*" class="hidden" onchange="previewBrochureImage(this)">
                                        <label for="brochure_image" class="cursor-pointer block">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-slate-400 mb-2"></i>
                                            <p class="text-sm text-slate-600 font-medium">Klik untuk upload gambar</p>
                                            <p class="text-xs text-slate-400 mt-1">PNG, JPG max 2MB</p>
                                        </label>
                                    </div>
                                    <div class="mt-3 p-3 bg-blue-50 rounded-lg border border-blue-100">
                                        <p class="text-xs text-blue-700 font-medium mb-1"><i class="fas fa-info-circle mr-1"></i> Rekomendasi Ukuran:</p>
                                        <ul class="text-xs text-blue-600 space-y-1">
                                            <li>• Rasio <strong>3:4</strong> (Portrait)</li>
                                            <li>• Ukuran: <strong>600 x 800 px</strong> atau kelipatan</li>
                                            <li>• Format: PNG/JPG</li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-slate-500 mb-2">Preview:</p>
                                    <div class="aspect-[3/4] bg-slate-100 rounded-lg overflow-hidden border border-slate-200 flex items-center justify-center" id="brochure_preview_container">
                                        @if(isset($page->content['brochure']['image']) && $page->content['brochure']['image'])
                                            <img src="{{ Storage::url($page->content['brochure']['image']) }}" alt="Brosur Preview" class="w-full h-full object-cover" id="brochure_preview">
                                        @else
                                            <div class="text-center p-4" id="brochure_placeholder">
                                                <i class="fas fa-image text-4xl text-slate-300 mb-2"></i>
                                                <p class="text-xs text-slate-400">Belum ada gambar</p>
                                            </div>
                                            <img src="" alt="Brosur Preview" class="w-full h-full object-cover hidden" id="brochure_preview">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Brosur</label>
                                <input type="text" name="content[brochure][title]" value="{{ $page->content['brochure']['title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Unduh Brosur PPDB">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">No. WhatsApp Panitia</label>
                                <input type="text" name="content[contact][whatsapp]" value="{{ $page->content['contact']['whatsapp'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="6281234567890">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Brosur</label>
                            <textarea name="content[brochure][description]" rows="2" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition" placeholder="Deskripsi singkat tentang isi brosur">{{ $page->content['brochure']['description'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <script>
                    function previewBrochureImage(input) {
                        const preview = document.getElementById('brochure_preview');
                        const placeholder = document.getElementById('brochure_placeholder');
                        
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                                preview.classList.remove('hidden');
                                if (placeholder) placeholder.classList.add('hidden');
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>
                
                <!-- Action Buttons -->
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.pages.index') }}">
                            <x-ui.button variant="secondary" type="button">
                                Batal
                            </x-ui.button>
                        </a>
                        <x-ui.button variant="primary" type="submit">
                            <i class="fas fa-save mr-2"></i>
                            Update Halaman PPDB
                        </x-ui.button>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <div class="max-w-md mx-auto">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tools text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Form Belum Tersedia</h3>
                <p class="text-gray-500">Form edit untuk halaman ini sedang dalam pengembangan.</p>
            </div>
        </div>
    @endif
</div>
@endsection
