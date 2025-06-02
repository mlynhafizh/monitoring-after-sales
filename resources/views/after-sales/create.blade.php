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
        <label class="block mb-1">Apakah Ada Kendala?</label>
        <select name="ada_kendala" id="ada_kendala" class="w-full border p-2 rounded" required>
            <option value="Tidak ada">Tidak ada Kendala</option>
            <option value="Ada">Ada</option>
        </select>
    </div>

    <div id="form_kendala" class="hidden">
        <label class="block mb-1 mt-4">Tuliskan Kendalanya</label>
        <input type="text" name="kendala" id="kendala_input" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="block mb-1">Produk Mandiri apa yang sudah ditawarkan?</label>
        <input type="text" name="cross_selling" class="w-full border p-2 rounded" required>

    </div>
    <div class="pt-4 pb-24">
        <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white py-2 px-4 rounded">
            Simpan
        </button>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const adaKendalaSelect = document.getElementById('ada_kendala');
        const kendalaInputDiv = document.getElementById('form_kendala');
        const kendalaInput = document.getElementById('kendala_input');

        function toggleKendalaField() {
            if (adaKendalaSelect.value === 'Ada') {
                kendalaInputDiv.classList.remove('hidden');
                kendalaInput.required = true;
            } else {
                kendalaInputDiv.classList.add('hidden');
                kendalaInput.required = false;
                kendalaInput.value = '-'; // default jika tidak ada kendala
            }
        }

        adaKendalaSelect.addEventListener('change', toggleKendalaField);

        // Jalankan saat awal halaman dimuat
        toggleKendalaField();
    });
</script>
@endsection
