@extends('layouts.app')

@section('content')
<div class="p-4 sm:p-6 max-w-screen-xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-center sm:text-left">
        Welcome to Dashboard After Sales Livin' Merchant dan EDC Bank Mandiri Cabang Falatehan
    </h2>

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
        <h4 class="text-lg font-semibold">Halo, {{ Auth::user()->name ?? 'User' }}!</h4>

        <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col sm:flex-row sm:items-center gap-2">
            <label for="tanggal" class="sm:mr-2">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal"
                value="{{ request('tanggal') ?? \Carbon\Carbon::today()->toDateString() }}"
                class="border p-2 rounded w-full sm:w-auto">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full sm:w-auto">
                Filter
            </button>
        </form>
    </div>

    <div class="mb-6 bg-blue-100 text-blue-800 p-4 rounded text-center sm:text-left">
        Yang sudah melakukan After Sales sebanyak <strong>{{ $jumlah_user }}</strong> users
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pb-32">
        {{-- Kolom kiri: Pie Charts --}}
        <div class="space-y-6 md:col-span-1">
            {{-- Pie Chart Status Merchant --}}
            <div class="bg-white p-4 shadow rounded">
                <h3 class="text-lg font-semibold mb-2 text-center">Pie Chart Merchants Aktif / Non Aktif</h3>
                <div class="overflow-x-auto">
                    <canvas id="statusChart" width="300" height="300" class="mx-auto"></canvas>
                </div>
            </div>

            {{-- Pie Chart Kendala --}}
            <div class="bg-white p-4 shadow rounded">
                <h3 class="text-lg font-semibold mb-2 text-center">Pie Chart Kendala Merchant</h3>
                <div class="overflow-x-auto">
                    <canvas id="kendalaChart" width="300" height="300" class="mx-auto"></canvas>
                </div>
            </div>
        </div>

        {{-- Kolom kanan: Time Series Chart --}}
        <div class="md:col-span-2 bg-white p-4 shadow rounded">
            <h3 class="text-lg font-semibold mb-4 text-center md:text-left">Jumlah Merchants yang Berkendala per Hari</h3>
            <div class="overflow-x-auto">
                <canvas id="userChart" height="300" class="w-full max-w-full"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const statusChart = new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($status_data->pluck('status_merchant')) !!},
            datasets: [{
                data: {!! json_encode($status_data->pluck('total')) !!},
                backgroundColor: ['#60A5FA', '#F87171'],
            }]
        }
    });

    const kendalaChart = new Chart(document.getElementById('kendalaChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($kendala_data->pluck('ada_kendala')) !!},
            datasets: [{
                data: {!! json_encode($kendala_data->pluck('total')) !!},
                backgroundColor: ['#34D399', '#FBBF24'],
            }]
        }
    });

    const userChart = new Chart(document.getElementById('userChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyUsers->pluck('bulan')) !!},
            datasets: [{
                label: 'Jumlah User',
                data: {!! json_encode($monthlyUsers->pluck('total')) !!},
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                fill: true,
                tension: 0.3,
                pointBackgroundColor: '#3B82F6',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
@endsection
