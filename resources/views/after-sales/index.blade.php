{{-- @extends('layouts.app')

@section('content')

@php
    function sortLink($column, $label, $currentSort, $currentDirection) {
        $direction = ($currentSort === $column && $currentDirection === 'asc') ? 'desc' : 'asc';
        $arrow = ($currentSort === $column) ? ($currentDirection === 'asc' ? '▲' : '▼') : '';
        $url = request()->fullUrlWithQuery(['sort' => $column, 'direction' => $direction]);

        return "<a href='{$url}' class='hover:underline font-semibold'>{$label} {$arrow}</a>";
    }
@endphp


<h1 class="text-2xl font-bold mb-6">List Data After Sales</h1>

<div class="flex justify-between items-center mb-6">
    <div>
        <label for="tanggal_filter" class="mr-2 font-semibold">Tanggal:</label>
        <input type="date" name="tanggal_filter" id="tanggal_filter" class="border border-gray-300 p-2 rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300">
    </div>
    <a href="{{ route('after-sales.export') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
        Export to CSV
    </a>
</div>

<div class="overflow-x-auto bg-white rounded shadow">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-blue-600 text-white text-left">
            <tr>
                <th class="px-4 py-3">{!! sortLink('tanggal_after_sales', 'Tanggal After Sales', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('nip', 'NIP', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('jabatan', 'Jabatan', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('kode_cabang', 'Kode Cabang', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('merchant', 'Nama Merchant', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('tanggal_akuisisi', 'Tgl Akuisisi', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('status_merchant', 'Status', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('kendala', 'Kendala', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('cross_selling', 'Produk Ditawarkan', $sort, $direction) !!}</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($data as $row)
                <tr class="hover:bg-gray-50 text-gray-800">
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
            @empty
                <tr>
                    <td colspan="9" class="text-center text-gray-500 px-4 py-4">Tidak ada data tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection --}}

@extends('layouts.app')

@section('title', 'Dashboard - After Sales')

@section('content')
@php
    function sortLink($column, $label, $currentSort, $currentDirection) {
        $direction = ($currentSort === $column && $currentDirection === 'asc') ? 'desc' : 'asc';
        $arrow = ($currentSort === $column) ? ($currentDirection === 'asc' ? '▲' : '▼') : '';
        $url = request()->fullUrlWithQuery(['sort' => $column, 'direction' => $direction]);

        return "<a href='{$url}' class='hover:underline font-semibold'>{$label} {$arrow}</a>";
    }
@endphp

<div class="container mx-auto px-4 py-6 pb-32">
        <h1 class="text-2xl font-bold mb-6 text-black-800">After Sales Monitoring</h1>
        {{-- Filter tanggal --}}
        <form method="GET" action="{{ route('after-sales.index') }}" class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 space-y-2 sm:space-y-0 mb-4">
            <label for="tanggal_filter" class="font-semibold text-gray-700">Filter Tanggal:</label>
            <input type="date" name="tanggal_filter" id="tanggal_filter"
                value="{{ request('tanggal_filter') }}"
                onchange="this.form.submit()"
                class="border border-gray-300 p-2 rounded shadow-sm focus:outline-none focus:ring focus:border-blue-400">
            <noscript>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                    Filter
                </button>
            </noscript>
        </form>
        {{-- Tombol Export CSV --}}
        <div class="flex justify-end mb-2">
            <a href="{{ route('after-sales.export') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                Export to CSV
            </a>
        </div>
        {{-- Tabel After Sales --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
            <table class="w-full table-auto text-sm text-left text-gray-500">
                    <thead class="bg-blue-600 text-white text-left">
                        <tr>
                            <th class="px-4 py-3">{!! sortLink('tanggal_after_sales', 'Tanggal After Sales', $sort, $direction) !!}</th>
                            <th class="px-4 py-3">{!! sortLink('nip', 'NIP', $sort, $direction) !!}</th>
                            <th class="px-4 py-3">{!! sortLink('jabatan', 'Jabatan', $sort, $direction) !!}</th>
                            <th class="px-4 py-3">{!! sortLink('kode_cabang', 'Kode Cabang', $sort, $direction) !!}</th>
                            <th class="px-4 py-3">{!! sortLink('merchant', 'Nama Merchant', $sort, $direction) !!}</th>
                            <th class="px-4 py-3">{!! sortLink('tanggal_akuisisi', 'Tgl Akuisisi', $sort, $direction) !!}</th>
                            <th class="px-4 py-3">{!! sortLink('status_merchant', 'Status', $sort, $direction) !!}</th>
                            <th class="px-4 py-3">{!! sortLink('kendala', 'Kendala', $sort, $direction) !!}</th>
                            <th class="px-4 py-3">{!! sortLink('cross_selling', 'Produk Ditawarkan', $sort, $direction) !!}</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($data as $row)
                        <tr class="hover:bg-gray-50 text-gray-800">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($row->tanggal_after_sales)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2">{{ $row->nip }}</td>
                            <td class="px-4 py-2">{{ $row->jabatan }}</td>
                            <td class="px-4 py-2">{{ $row->kode_cabang }}</td>
                            <td class="px-4 py-2">{{ $row->merchant }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($row->tanggal_akuisisi)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2">{{ $row->status_merchant }}</td>
                            <td class="px-4 py-2">{{ $row->kendala }}</td>
                            <td class="px-4 py-2">{{ $row->cross_selling }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('after-sales.edit', $row->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-xs">
                                    Edit
                                </a>
                                <form action="{{ route('after-sales.destroy', $row->id) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-xs">
                                            Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-gray-500 px-4 py-4">Tidak ada data tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $data->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
