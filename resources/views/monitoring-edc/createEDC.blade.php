@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Input Progress Livin' Merchant & EDC</h1>
{{-- Tampilkan error validasi --}}
@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('monitoring-edc.store') }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
    @csrf

    <div>
        <label class="block mb-1">No Rekening</label>
        <input type="text" name="no_rekening" class="w-full border p-2 rounded" required>
    </div>

    <div>
        <label class="block mb-1">Tanggal MTI</label>
        <input type="date" name="tanggal_mti" class="w-full border p-2 rounded" required>
    </div>

    <div>
        <label class="block mb-1">Nama Merchant</label>
        <input type="text" name="merchant" class="w-full border p-2 rounded" required>
    </div>

    <div>
        <label class="block mb-1">Official Name</label>
        <input type="text" name="official_name" class="w-full border p-2 rounded" required>
    </div>

    <div>
        <label class="block mb-1">Alamat</label>
        <textarea name="alamat" class="w-full border p-2 rounded" required></textarea>
    </div>

    <div>
        <label class="block mb-1">Kode Cabang</label>
        <select name="kd_cabang" class="w-full border p-2 rounded" required>
            <option value="12600">12600</option>
            <option value="12601">12601</option>
            <option value="12602">12602</option>
            <option value="12603">12603</option>
            <option value="12605">12605</option>
            <option value="12606">12606</option>
            <option value="12607">12607</option>
            <option value="12609">12609</option>
            <option value="12610">12610</option>
            <option value="12611">12611</option>
            <option value="12614">12614</option>
            <option value="12618">12618</option>
            <option value="12619">12619</option>
            <option value="12620">12620</option>
            <option value="12622">12622</option>
            <option value="12675">12675</option>
        </select>
    </div>

    <div>
        <label class="block mb-1">Progress</label>
        <input type="text" name="progress" class="w-full border p-2 rounded" placeholder="Contoh: Pending Doc" required>
    </div>

    <div>
        <label class="block mb-1">Keterangan Merchant</label>
        <input type="text" name="keterangan_merchant" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="block mb-1">Kategori</label>
        <input type="text" name="kategori" class="w-full border p-2 rounded" placeholder="Contoh: Sehat, Santap">
    </div>

    <div>
        <label class="block mb-1">MID</label>
        <input type="text" name="MID" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="block mb-1">Deadline</label>
        <input type="date" name="deadline" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="block mb-1">Status</label>
        <select name="status" class="w-full border p-2 rounded" required>
            <option value="">Pilih Status</option>
            <option value="On Proses">On Proses</option>
            <option value="Pending">Pending</option>
            <option value="Gagal">Gagal</option>
        </select>
    </div>

    <div>
        <label class="block mb-1">Keterangan</label>
        <textarea name="keterangan" class="w-full border p-2 rounded"></textarea>
    </div>

    <div class="pt-4 pb-24">
        <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white py-2 px-4 rounded">
            Simpan
        </button>
    </div>
</form>
@endsection
