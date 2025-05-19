@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Profil</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="name" class="block font-semibold">Nama</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required class="w-full border p-2 rounded">
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="w-full border p-2 rounded">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block font-semibold">Password Baru <small class="text-gray-500">(kosongkan jika tidak ingin mengganti)</small></label>
            <input id="password" name="password" type="password" class="w-full border p-2 rounded">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block font-semibold">Konfirmasi Password Baru</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
    </form>
</div>
@endsection
