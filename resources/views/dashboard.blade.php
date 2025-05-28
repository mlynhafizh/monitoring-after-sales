@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Welcome to Monitoring Dashboard After Sales Merchants Bank Mandiri Cabang Falatehan</h2>

    <div class="flex justify-between items-center mb-4">
        <div>
            <h4 class="text-xl font-semibold">Halo, {{ Auth::user()->name ?? 'User' }}!</h4>
        </div>
        {{-- <div>
            <label class="mr-2">Tanggal:</label>
            <input type="date" class="border p-2 rounded">
        </div> --}}
        <form method="GET" action="{{ route('dashboard') }}" class="flex items-center mb-4">
            <label for="tanggal" class="mr-2">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal"
            value="{{ request('tanggal') ?? \Carbon\Carbon::today()->toDateString() }}"
            class="border p-2 rounded mr-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
        </form>
    </div>

    <div class="mb-4 bg-blue-100 text-blue-800 p-4 rounded">
        Yang sudah melakukan After Sales sebanyak <strong>{{ $jumlah_user }}</strong> users
    </div>

    <div class="grid grid-cols-1 gap-6">
        {{-- Pie Chart Status Merchant --}}
        <div>
            <h3 class="text-lg font-semibold mb-2">Pie Chart Merchants Aktif / Non Aktif</h3>
            <canvas id="statusChart" width="300" height="300" class="mx-auto"></canvas>
        </div>

        {{-- Pie Chart Kendala --}}
        <div>
            <h3 class="text-lg font-semibold mb-2">Pie Chart Kendala Merchant</h3>
            <canvas id="kendalaChart" width="300" height="300" class="mx-auto"></canvas>
        </div>
    </div>

    <div>
        <h3 class="text-lg font-semibold mb-2">Jumlah User After Sales </h3>
        <canvas id="userChart" height="120"></canvas>
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
</script>

{{-- <script>
    const ctx = document.getElementById('timeseriesChart').getContext('2d');
    const timeseriesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyUsers->pluck('bulan')) !!},
            datasets: [{
                label: 'Jumlah NIP Unik per Bulan',
                data: {!! json_encode($monthlyUsers->pluck('total')) !!},
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
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
</script> --}}

<script>
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
