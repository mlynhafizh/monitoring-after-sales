@extends('layouts.app')

@section('title', 'Dashboard - Monitoring EDC')

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
    <h1 class="text-2xl font-bold mb-6 text-black-800">Monitoring EDC</h1>

    {{-- Filter dan Search --}}
    <form method="GET" action="{{ route('monitoring-edc.index') }}" class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 space-y-2 sm:space-y-0 mb-4">
        <label for="search" class="font-semibold text-gray-700">Search:</label>
        <input type="text" name="search" id="search" placeholder="Cari nama merchant, progress..."
            value="{{ request('search') }}"
            class="border border-gray-300 p-2 rounded shadow-sm focus:outline-none focus:ring focus:border-blue-400 w-full sm:w-auto">

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            Cari
        </button>
        
        <div class="flex justify-end mb-4">
            <a href="{{ route('monitoring-edc.export') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                Export to CSV
            </a>
        </div>
    </form>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full table-auto text-sm text-left text-gray-500">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-3">{!! sortLink('no_rekening', 'No Rekening', $sort, $direction) !!}</th>
                    <th class="px-4 py-3">{!! sortLink('tanggal_mti', 'Tanggal MTI', $sort, $direction) !!}</th>
                    <th class="px-4 py-3">{!! sortLink('merchant', 'Merchant', $sort, $direction) !!}</th>
                    <th class="px-4 py-3">{!! sortLink('official_name', 'Official Name', $sort, $direction) !!}</th>
                    <th class="px-4 py-3">{!! sortLink('alamat', 'Alamat', $sort, $direction) !!}</th>
                    <th class="px-4 py-3">{!! sortLink('kd_cabang', 'Cabang', $sort, $direction) !!}</th>
                    <th class="px-4 py-3">{!! sortLink('progress', 'Progress', $sort, $direction) !!}</th>
                    <th class="px-4 py-3">{!! sortLink('keterangan_merchant', 'Keterangan', $sort, $direction) !!}</th>
                    <th class="px-4 py-3">{!! sortLink('kategori', 'Kategori', $sort, $direction) !!}</th>
                    <th class="px-4 py-3">{!! sortLink('MID', 'MID', $sort, $direction) !!}</th>
                    <th class="px-4 py-3">{!! sortLink('status', 'Status', $sort, $direction) !!}</th>
                    <th class="px-4 py-3">{!! sortLink('deadline', 'Deadline', $sort, $direction) !!}</th>
                    <th class="px-4 py-3">{!! sortLink('keterangan', 'Keterangan', $sort, $direction) !!}</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($data as $row)
                    <tr class="hover:bg-gray-50 text-gray-800">
                        <td class="px-4 py-2">{{ $row->no_rekening }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($row->tanggal_mti)->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">{{ $row->merchant }}</td>
                        <td class="px-4 py-2">{{ $row->official_name }}</td>
                        <td class="px-4 py-2">{{ $row->alamat }}</td>
                        <td class="px-4 py-2">{{ $row->kd_cabang }}</td>
                        <td class="px-4 py-2">{{ $row->progress }}</td>
                        <td class="px-4 py-2">{{ $row->keterangan_merchant }}</td>
                        <td class="px-4 py-2">{{ $row->kategori }}</td>
                        <td class="px-4 py-2">{{ $row->MID }}</td>
                        <td class="px-4 py-2">{{ $row->status }}</td>
                        <td class="px-4 py-2">{{ $row->deadline }}</td>
                        <td class="px-4 py-2">{{ $row->keterangan }}</td>
                        <td class="px-4 py-2">
                            <div class="flex space-x-2">
                                <a href="{{ route('monitoring-edc.edit', $row->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs shadow">
                                    Edit
                                </a>
                                <form action="{{ route('monitoring-edc.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs shadow">
                                        Hapus
                                    </button>
                                </form>
                            </div>
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
