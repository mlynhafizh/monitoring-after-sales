@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">List Profile Merchant</h1>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@php
    function sortLink($column, $label, $currentSort, $currentDirection) {
        $direction = ($currentSort === $column && $currentDirection === 'asc') ? 'desc' : 'asc';
        $arrow = ($currentSort === $column) ? ($currentDirection === 'asc' ? '▲' : '▼') : '';
        $url = request()->fullUrlWithQuery(['sort' => $column, 'direction' => $direction]);

        return "<a href='{$url}' class='hover:underline font-semibold'>{$label} {$arrow}</a>";
    }
@endphp


<div class="overflow-x-auto">
        <form method="GET" action="{{ route('profile-merchant.index') }}" class="flex items-center space-x-2 mb-6">
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
    <div class="flex justify-end mb-2">
        <a href="{{ route('profile-merchant.export') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
            Export to CSV
        </a>
    </div>
    <table class="min-w-full bg-white border border-gray-300 text-sm">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-4 py-3">{!! sortLink('tanggal_gabung', 'Tgl Akuisisi', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('nama_merchant', 'Nama Merchant', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('alamat', 'Alamat', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('payroll', 'Payroll', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('deposito', 'Deposito', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('mtb', 'Mandiri Tabungan Bisnis', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('giro', 'Giro', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('kredit_sme', 'Kredit SME', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('kredit_kum_kur', 'Kredit KUM/KUR', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('mandiri_cm', 'Mandiri Cash Management', $sort, $direction) !!}</th>
                <th class="px-4 py-3">{!! sortLink('livin', 'Livin', $sort, $direction) !!}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($merchants as $m)
                <tr class="text-center">
                    <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($m->tanggal_gabung)->format('d-m-Y') }}</td>
                    <td class="px-4 py-2 border">{{ $m->nama_merchant }}</td>
                    <td class="px-4 py-2 border text-left">{{ $m->alamat }}</td>
                    <td class="px-4 py-2 border">{{ $m->payroll }}</td>
                    <td class="px-4 py-2 border">{{ $m->deposito }}</td>
                    <td class="px-4 py-2 border">{{ $m->mtb }}</td>
                    <td class="px-4 py-2 border">{{ $m->giro }}</td>
                    <td class="px-4 py-2 border">{{ $m->kredit_sme }}</td>
                    <td class="px-4 py-2 border">{{ $m->kredit_kum_kur }}</td>
                    <td class="px-4 py-2 border">{{ $m->mandiri_cm }}</td>
                    <td class="px-4 py-2 border">{{ $m->livin }}</td>
                    {{-- <td class="px-4 py-2 border">{{ $m->no_hp }}</td>
                    <td class="px-4 py-2 border">{{ $m->email }}</td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="13" class="px-4 py-2 border text-center text-gray-500">Belum ada data merchant.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
