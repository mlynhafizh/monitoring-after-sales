@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">List Data After Sales</h1>

<div class="flex justify-between items-center mb-4">
    <div>
        <label class="mr-2">Tanggal:</label>
        <input type="date" name="tanggal_filter" class="border p-2 rounded">
    </div>
    <a href="{{ route('after-sales.export') }}" class="bg-green-600 text-white px-4 py-2 rounded">Export to CSV</a>
</div>

<table class="w-full bg-white rounded shadow">
    <thead>
        <tr>
            <th class="px-4 py-2">Tanggal After Sales</th>
            <th class="px-4 py-2">NIP</th>
            <th class="px-4 py-2">Jabatan</th>
            <th class="px-4 py-2">Kode Cabang</th>
            <th class="px-4 py-2">Nama Merchant</th>
            <th class="px-4 py-2">Tanggal Akuisisi Merchant</th>
            <th class="px-4 py-2">Status Merchant</th>
            <th class="px-4 py-2">Kendala</th>
            <th class="px-4 py-2">Produk Mandiri yang ditawarkan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr class="border-t border-gray-300 dark:border-gray-700">
                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($row->tanggal_after_sales)->format('d-m-Y') }}</td>
                <td class="px-4 py-2">{{ $row->nip }}</td>
                <td class="px-4 py-2">{{ $row->jabatan }}</td>
                <td class="px-4 py-2">{{ $row->kode_cabang }}</td>
                <td class="px-4 py-2">{{ $row->merchant }}</td>
                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($row->tanggal_akuisisi)->format('d-m-Y') }}</td>
                <td class="px-4 py-2">{{ $row->status_merchant }}</td>
                <td class="px-4 py-2">{{ $row->kendala }}</td>
                <td class="px-4 py-2">{{ $row->cross_selling }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
