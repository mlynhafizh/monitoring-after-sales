{{-- @extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Input Data Profile Merchant</h1>
<form action="{{ route('profile-merchant.store') }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
    @csrf
    <div class="container">
        <form action="{{ route('profile-merchant.store') }}" method="POST">
            @csrf
            <div class="form-group mb-2">
                <label>Tanggal Akuisisi</label>
                <input type="date" name="tanggal_gabung" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label>Nama Merchant</label>
                <input type="text" name="nama_merchant" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required></textarea>
            </div>
            <div class="form-group mb-2">
                <label class="block mb-1">Payroll</label>
                <select name="payroll" class="w-full border p-2 rounded">
                    <option value="Y">Y</option>
                    <option value="N">N</option>
            </div>
            <div class="form-group mb-2">
                <label class="block mb-1">Deposito</label>
                <select name="deposito" class="w-full border p-2 rounded">
                    <option value="Y">Y</option>
                    <option value="N">N</option>
            </div>
            <div class="form-group mb-2">
                <label class="block mb-1">Mandiri Tabungan Bisnis</label>
                <select name="mtb" class="w-full border p-2 rounded">
                    <option value="Y">Y</option>
                    <option value="N">N</option>
            </div>
            <div class="form-group mb-2">
                <label class="block mb-1">Giro</label>
                <select name="giro" class="w-full border p-2 rounded">
                    <option value="Y">Y</option>
                    <option value="N">N</option>
            </div>
            <div class="form-group mb-2">
                <label class="block mb-1">Kredit SME</label>
                <select name="kredit_sme" class="w-full border p-2 rounded">
                    <option value="Y">Y</option>
                    <option value="N">N</option>
            </div>
            <div class="form-group mb-2">
                <label class="block mb-1">Kredit KUM/KUR</label>
                <select name="kredit_kum_kur" class="w-full border p-2 rounded">
                    <option value="Y">Y</option>
                    <option value="N">N</option>
            </div>
            <div class="form-group mb-2">
                <label class="block mb-1">Mandiri Cash Management</label>
                <select name="mandiri_cm" class="w-full border p-2 rounded">
                    <option value="Y">Y</option>
                    <option value="N">N</option>
            </div>
            <div class="form-group mb-2">
                <label class="block mb-1">Livin'</label>
                <select name="livin" class="w-full border p-2 rounded">
                    <option value="Y">Y</option>
                    <option value="N">N</option>
            </div>
            <div class="form-group mb-2">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label>Email (Opsional)</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group mb-2">
                <label>Tanggal Gabung (Opsional)</label>
                <input type="date" name="tanggal_gabung" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</form>
@endsection --}}
@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Input Data Profile Merchant</h1>

<form action="{{ route('profile-merchant.store') }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
    @csrf

    <div class="space-y-4">
        <div>
            <label class="block font-semibold">Tanggal Akuisisi</label>
            <input type="date" name="tanggal_gabung" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Nama Merchant</label>
            <input type="text" name="nama_merchant" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Alamat</label>
            <textarea name="alamat" class="w-full border p-2 rounded" required></textarea>
        </div>

        <div>
            <label class="block font-semibold">Payroll</label>
            <select name="payroll" class="w-full border p-2 rounded" required>
                <option value="Y">Y</option>
                <option value="N">N</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold">Deposito</label>
            <select name="deposito" class="w-full border p-2 rounded" required>
                <option value="Y">Y</option>
                <option value="N">N</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold">Mandiri Tabungan Bisnis (MTB)</label>
            <select name="mtb" class="w-full border p-2 rounded" required>
                <option value="Y">Y</option>
                <option value="N">N</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold">Giro</label>
            <select name="giro" class="w-full border p-2 rounded" required>
                <option value="Y">Y</option>
                <option value="N">N</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold">Kredit SME</label>
            <select name="kredit_sme" class="w-full border p-2 rounded" required>
                <option value="Y">Y</option>
                <option value="N">N</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold">Kredit KUM/KUR</label>
            <select name="kredit_kum_kur" class="w-full border p-2 rounded" required>
                <option value="Y">Y</option>
                <option value="N">N</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold">Mandiri Cash Management (MCM)</label>
            <select name="mandiri_cm" class="w-full border p-2 rounded" required>
                <option value="Y">Y</option>
                <option value="N">N</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold">Livin'</label>
            <select name="livin" class="w-full border p-2 rounded" required>
                <option value="Y">Y</option>
                <option value="N">N</option>
            </select>
        </div>

        <div>
            {{-- <label class="block font-semibold">No HP</label>
            <input type="text" name="no_hp" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Email (Opsional)</label>
            <input type="email" name="email" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-semibold">Tanggal Gabung (Opsional)</label>
            <input type="date" name="tanggal_gabung_optional" class="w-full border p-2 rounded">
        </div> --}}

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">
                Simpan
            </button>
        </div>
    </div>
</form>
@endsection
