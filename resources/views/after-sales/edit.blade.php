@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Edit After Sales</h2>
    
    <form action="{{ route('after-sales.update', $afterSales->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1">Tanggal After Sales</label>
            <input type="date" name="tanggal_after_sales" value="{{ old('tanggal_after_sales', $afterSales->tanggal_after_sales) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block mb-1">NIP</label>
            <input type="text" name="nip" value="{{ old('nip', $afterSales->nip) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block mb-1">Jabatan</label>
            <input type="text" name="jabatan" value="{{ old('jabatan', $afterSales->jabatan) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block mb-1">Nama Merchant</label>
            <input type="text" name="merchant" value="{{ old('merchant', $afterSales->merchant) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block mb-1">Tanggal Akuisisi Merchant</label>
            <input type="date" name="tanggal_akuisisi" value="{{ old('tanggal_akuisisi', $afterSales->tanggal_akuisisi) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block mb-1">Status Merchant</label>
            <select name="status_merchant" class="w-full border p-2 rounded" required>
                <option value="Aktif" {{ old('status_merchant', $afterSales->status_merchant) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonAktif" {{ old('status_merchant', $afterSales->status_merchant) == 'nonAktif' ? 'selected' : '' }}>Non Aktif</option>
            </select>
        </div>
        <div>
            <label class="block mb-1">Kode Cabang</label>
            <select name="kode_cabang" class="w-full border p-2 rounded" required>
                <option value="12600" {{ old('kode_cabang', $afterSales->kode_cabang) == '12600' ? 'selected' : '' }}>12600</option>
                <option value="12601" {{ old('kode_cabang', $afterSales->kode_cabang) == '12601' ? 'selected' : '' }}>12601</option>
                <option value="12602" {{ old('kode_cabang', $afterSales->kode_cabang) == '12602' ? 'selected' : '' }}>12602</option>
                <option value="12603" {{ old('kode_cabang', $afterSales->kode_cabang) == '12603' ? 'selected' : '' }}>12603</option>
                <option value="12605" {{ old('kode_cabang', $afterSales->kode_cabang) == '12605' ? 'selected' : '' }}>12605</option>
                <option value="12606" {{ old('kode_cabang', $afterSales->kode_cabang) == '12606' ? 'selected' : '' }}>12606</option>
                <option value="12607" {{ old('kode_cabang', $afterSales->kode_cabang) == '12607' ? 'selected' : '' }}>12607</option>
                <option value="12609" {{ old('kode_cabang', $afterSales->kode_cabang) == '12609' ? 'selected' : '' }}>12609</option>
                <option value="12610" {{ old('kode_cabang', $afterSales->kode_cabang) == '12610' ? 'selected' : '' }}>12610</option>
                <option value="12611" {{ old('kode_cabang', $afterSales->kode_cabang) == '12611' ? 'selected' : '' }}>12611</option>
                <option value="12614" {{ old('kode_cabang', $afterSales->kode_cabang) == '12614' ? 'selected' : '' }}>12614</option>
                <option value="12618" {{ old('kode_cabang', $afterSales->kode_cabang) == '12618' ? 'selected' : '' }}>12618</option>
                <option value="12619" {{ old('kode_cabang', $afterSales->kode_cabang) == '12619' ? 'selected' : '' }}>12619</option>
                <option value="12620" {{ old('kode_cabang', $afterSales->kode_cabang) == '12620' ? 'selected' : '' }}>12620</option>
                <option value="12622" {{ old('kode_cabang', $afterSales->kode_cabang) == '12622' ? 'selected' : '' }}>12622</option>
                <option value="12675" {{ old('kode_cabang', $afterSales->kode_cabang) == '12675' ? 'selected' : '' }}>12675</option>
            </select>
        </div>
        <div>
            <label class="block mb-1">Kendala (Jika tidak ada ketik "-")</label>
            <input type="text" name="kendala" value="{{ old('kendala', $afterSales->kendala) }}" class="w-full border p-2 rounded" required>
        </div>
        <div>
            <label class="block mb-1">Produk Mandiri apa yang sudah ditawarkan?</label>
            <input type="text" name="cross_selling" value="{{ old('cross_selling', $afterSales->cross_selling) }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
