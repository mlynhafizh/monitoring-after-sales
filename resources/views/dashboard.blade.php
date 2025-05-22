@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Welcome to Monitoring Dashboard After Sales Merchants Bank Mandiri Cabang Falatehan</h2>

    <div class="flex justify-between items-center mb-4">
        <div>
            <h4 class="text-xl font-semibold">Halo, {{ Auth::user()->name ?? 'User' }}!</h4>
        </div>
        <div>
            <label class="mr-2">Tanggal:</label>
            <input type="date" class="border p-2 rounded">
        </div>
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
@endsection
