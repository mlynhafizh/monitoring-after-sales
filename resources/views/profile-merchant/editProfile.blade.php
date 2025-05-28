@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Edit Profile Merchant</h2>

    <form action="{{ route('profile-merchant.update', $merchant->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Tanggal Akuisisi</label>
            <input type="date" name="tanggal_gabung" value="{{ old('tanggal_gabung', $merchant->tanggal_gabung) }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Nama Merchant</label>
            <input type="text" name="nama_merchant" value="{{ old('nama_merchant', $merchant->nama_merchant) }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Alamat</label>
            <textarea name="alamat" class="w-full border p-2 rounded" required>{{ old('alamat', $merchant->alamat) }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $merchant->no_hp) }}" class="w-full border p-2 rounded">
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
        
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
