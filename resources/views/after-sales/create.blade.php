@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Input Data After Sales</h1>

<form action="{{ route('after-sales.store') }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
    @csrf
    <div>
        <label class="block mb-1">Tanggal After Sales </label>
        <input type="date" name="tanggal_after_sales" class="w-full border p-2 rounded" required>
    </div>
    <div>
        <label class="block mb-1">NIP</label>
        <input type="text" name="nip" class="w-full border p-2 rounded" required>
    </div>
    <div>
        <label class="block mb-1">Jabatan</label>
        <input type="text" name="jabatan" class="w-full border p-2 rounded" required>
    </div>
    <div>
        <label class="block mb-1">Nama Merchant</label>
        <input type="text" name="merchant" class="w-full border p-2 rounded" required>
    </div>
    <div>
        <label class="block mb-1">Tanggal Akuisisi Merchant </label>
        <input type="date" name="tanggal_akuisisi" class="w-full border p-2 rounded" required>
    </div>
    <div>
        <label class="block mb-1">Status Merchant</label>
        <select name="status_merchant" class="w-full border p-2 rounded">
            <option value="Aktif">Aktif</option>
            <option value="nonAktif">Non Aktif</option>
        </select>
    </div>
    <div>
        <label class="block mb-1">Kode Cabang</label>
        <select name="kode_cabang" class="w-full border p-2 rounded">
            <option value="12600">12600</option>
        </select>
    </div>
    <div>
        <label class="block mb-1">Kendala (Jika tidak ada ketik "-")</label>
        <input type="text" name="kendala" class="w-full border p-2 rounded" required>
    </div>
        <div>
        <label class="block mb-1">Produk Mandiri apa yang sudah ditawarkan?</label>
        <input type="text" name="cross_selling" class="w-full border p-2 rounded" required>

    </div>
    <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white py-2 px-4 rounded">Simpan</button>
</form>
@endsection
