@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">List Profile Merchant</h1>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-300 text-sm">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-4 py-2 border">Tgl Akuisisi</th>
                <th class="px-4 py-2 border">Nama Merchant</th>
                <th class="px-4 py-2 border">Alamat</th>
                <th class="px-4 py-2 border">Payroll</th>
                <th class="px-4 py-2 border">Deposito</th>
                <th class="px-4 py-2 border">MTB</th>
                <th class="px-4 py-2 border">Giro</th>
                <th class="px-4 py-2 border">Kredit SME</th>
                <th class="px-4 py-2 border">Kredit KUM/KUR</th>
                <th class="px-4 py-2 border">Mandiri CM</th>
                <th class="px-4 py-2 border">Livin'</th>
                {{-- <th class="px-4 py-2 border">No HP</th>
                <th class="px-4 py-2 border">Email</th> --}}
            </tr>
        </thead>
        <tbody>
            @forelse($merchants as $m)
                <tr class="text-center">
                    <td class="px-4 py-2 border">{{ $m->tanggal_gabung }}</td>
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
