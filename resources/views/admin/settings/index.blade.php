@extends('layouts.admin')

@section('title', 'Pengaturan Menu')

@section('content')
<div class="w-full">
    <x-admin.page-header 
        title="Pengaturan" 
        description="Kelola visibility menu di navbar homepage dan warna tema website"
        icon="fas fa-cog"
    />

    <!-- Alert -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded shadow-sm flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <p>{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- 2 Column Grid Layout -->
    <div class="grid lg:grid-cols-2 gap-6">
        <!-- Left Column: Menu Settings -->
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden h-full flex flex-col">
                <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-4">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <i class="fas fa-bars mr-3"></i> Menu Navigasi
                    </h3>
                    <p class="text-primary-100 text-sm mt-1">Aktifkan atau nonaktifkan menu yang ditampilkan di navbar</p>
                </div>
                
                <div class="p-6 flex-1">
                    <div class="space-y-4">
                        @foreach($settings as $key => $setting)
                            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg border border-slate-200 hover:border-primary-300 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-link text-primary-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-slate-900">{{ $setting['label'] }}</h4>
                                        <p class="text-sm text-slate-500">Menu {{ $setting['label'] }} di navbar</p>
                                    </div>
                                </div>
                                
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="{{ $key }}" value="1" class="sr-only peer" {{ $setting['enabled'] ? 'checked' : '' }}>
                                    <div class="w-14 h-7 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-green-600"></div>
                                    <span class="ml-3 text-sm font-medium {{ $setting['enabled'] ? 'text-green-600' : 'text-gray-500' }}">
                                        {{ $setting['enabled'] ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-info-circle text-blue-600 mt-0.5"></i>
                            <div class="text-sm text-blue-800">
                                <p class="font-semibold mb-1">Informasi:</p>
                                <ul class="list-disc list-inside space-y-1 text-blue-700">
                                    <li>Menu yang dinonaktifkan tidak akan muncul di navbar homepage</li>
                                    <li>Perubahan akan langsung terlihat setelah disimpan</li>
                                    <li>Minimal satu menu harus tetap aktif</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-end gap-3">
                    <x-ui.button variant="primary" type="submit">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Menu
                    </x-ui.button>
                </div>
            </div>
        </form>

        <!-- Right Column: Theme Colors Settings -->
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden h-full flex flex-col">
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-4">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <i class="fas fa-palette mr-3"></i> Warna Tema
                    </h3>
                    <p class="text-purple-100 text-sm mt-1">Sesuaikan warna utama website</p>
                </div>
                
                <div class="p-6 flex-1">
                    <div class="space-y-6">
                        <!-- Primary Color -->
                        <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
                            <label class="block text-sm font-semibold text-slate-700 mb-3">Warna Utama (Primary)</label>
                            <div class="flex items-center gap-4">
                                <input type="color" name="theme_primary_color" value="{{ $primaryColor }}" class="h-12 w-20 rounded border-2 border-slate-300 cursor-pointer">
                                <div class="flex-1">
                                    <input type="text" value="{{ $primaryColor }}" readonly class="w-full px-4 py-2 bg-white rounded border border-slate-300 font-mono text-sm">
                                    <p class="text-xs text-slate-500 mt-1">Digunakan untuk tombol, link, dan elemen utama</p>
                                </div>
                            </div>
                            <div class="mt-4 p-3 rounded" style="background-color: {{ $primaryColor }}">
                                <p class="text-white text-sm font-medium">Preview Warna Primary</p>
                            </div>
                        </div>

                        <!-- Secondary Color -->
                        <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
                            <label class="block text-sm font-semibold text-slate-700 mb-3">Warna Sekunder (Secondary)</label>
                            <div class="flex items-center gap-4">
                                <input type="color" name="theme_secondary_color" value="{{ $secondaryColor }}" class="h-12 w-20 rounded border-2 border-slate-300 cursor-pointer">
                                <div class="flex-1">
                                    <input type="text" value="{{ $secondaryColor }}" readonly class="w-full px-4 py-2 bg-white rounded border border-slate-300 font-mono text-sm">
                                    <p class="text-xs text-slate-500 mt-1">Digunakan untuk aksen dan elemen pendukung</p>
                                </div>
                            </div>
                            <div class="mt-4 p-3 rounded" style="background-color: {{ $secondaryColor }}">
                                <p class="text-white text-sm font-medium">Preview Warna Secondary</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5"></i>
                            <div class="text-sm text-yellow-800">
                                <p class="font-semibold mb-1">Perhatian:</p>
                                <ul class="list-disc list-inside space-y-1 text-yellow-700">
                                    <li>Perubahan warna akan mempengaruhi seluruh tampilan website</li>
                                    <li>Pastikan warna yang dipilih memiliki kontras yang baik</li>
                                    <li>Gunakan tombol "Reset ke Default" untuk mengembalikan warna awal</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-end gap-3">
                    <x-ui.button variant="primary" type="submit">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Warna
                    </x-ui.button>
                </div>
            </div>
        </form>

        <!-- Reset Button (Separate Form) -->
        <form action="{{ route('admin.settings.reset') }}" method="POST" class="lg:col-span-2">
            @csrf
            <div class="bg-gradient-to-r from-orange-50 to-yellow-50 border-2 border-orange-200 rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-undo text-orange-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 mb-1">Reset Warna ke Default</h4>
                            <p class="text-sm text-slate-600">Kembalikan warna tema ke pengaturan awal (Primary: #2563eb, Secondary: #1c7ed6)</p>
                        </div>
                    </div>
                    <button type="submit" onclick="return confirm('Yakin ingin reset warna ke default? Perubahan tidak dapat dibatalkan.')" class="px-6 py-2.5 bg-white border-2 border-orange-400 text-orange-700 font-semibold rounded-lg hover:bg-orange-50 transition flex-shrink-0">
                        <i class="fas fa-undo mr-2"></i>
                        Reset ke Default
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Add toggle animation and color change
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const label = this.closest('label').querySelector('span');
            if (this.checked) {
                label.textContent = 'Aktif';
                label.classList.remove('text-gray-500');
                label.classList.add('text-green-600');
            } else {
                label.textContent = 'Nonaktif';
                label.classList.remove('text-green-600');
                label.classList.add('text-gray-500');
            }
        });
    });

    // Color picker real-time preview
    document.querySelectorAll('input[type="color"]').forEach(colorInput => {
        colorInput.addEventListener('input', function() {
            const container = this.closest('.bg-slate-50');
            const textInput = container.querySelector('input[type="text"]');
            const preview = container.querySelector('.mt-4');
            
            textInput.value = this.value;
            preview.style.backgroundColor = this.value;
        });
    });
</script>
@endsection
