@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<div class="max-w-full mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Pengguna</h1>
        <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <p class="text-gray-500">Edit informasi pengguna: <strong>{{ $user->name }}</strong></p>
        </div>
        
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <x-ui.input 
                    label="Nama Lengkap" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $user->name) }}" 
                    required 
                />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <x-ui.input 
                    label="Email Address" 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email', $user->email) }}" 
                    required 
                />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Role -->
                <div>
                    <x-ui.select label="Role" id="role" name="role" required>
                        <option value="">Pilih Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                                {{ ucfirst($role) }}
                            </option>
                        @endforeach
                    </x-ui.select>
                    @error('role')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <x-ui.input 
                        label="Nomor Telepon (Opsional)" 
                        id="phone" 
                        name="phone" 
                        value="{{ old('phone', $user->phone) }}" 
                    />
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="bg-blue-50 p-4 rounded-lg">
                <p class="text-sm text-blue-800 mb-2 font-semibold">Ubah Password</p>
                <p class="text-xs text-blue-600 mb-4">Kosongkan jika tidak ingin mengubah password.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password -->
                    <div>
                        <x-ui.input 
                            label="Password Baru" 
                            id="password" 
                            type="password" 
                            name="password" 
                        />
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div>
                        <x-ui.input 
                            label="Konfirmasi Password" 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                        />
                    </div>
                </div>
            </div>

            <!-- Address -->
            <div>
                <x-ui.textarea 
                    label="Alamat (Opsional)" 
                    id="address" 
                    name="address" 
                    rows="3"
                >{{ old('address', $user->address) }}</x-ui.textarea>
                @error('address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.users.index') }}">
                    <x-ui.button variant="secondary" type="button">
                        Batal
                    </x-ui.button>
                </a>
                <x-ui.button variant="primary" type="submit">
                    Simpan Perubahan
                </x-ui.button>
            </div>
        </form>
    </div>
</div>
@endsection
