<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AfterSales;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal dari query string atau gunakan hari ini
        $tanggal = $request->input('tanggal', Carbon::today()->toDateString());

        // Konversi ke awal dan akhir hari
        $start = Carbon::parse($tanggal)->startOfDay();
        $end = Carbon::parse($tanggal)->endOfDay();

        // Ambil semua data yang dibuat pada tanggal tersebut
        $filtered = AfterSales::whereBetween('tanggal_after_sales', [$start, $end]);

        // Gunakan hasil filter untuk semua query
        // Jumlah user yang melakukan after sales
        $jumlah_user = (clone $filtered)->select('nip')->distinct()->count();

        $status_data = (clone $filtered)
            ->select('status_merchant', DB::raw('count(*) as total'))
            ->groupBy('status_merchant')
            ->get();

        $aktif_merchant = (clone $filtered)->where('status_merchant', 'Aktif')->count();
        $nonAktif_merchant = (clone $filtered)->where('status_merchant', 'nonAktif')->count();

        $kendala = (clone $filtered)->where('kendala', '!=', '-')->whereNotNull('kendala')->count();
        $tidakKendala = (clone $filtered)->where('kendala', '-')->orWhereNull('kendala')->count();

        $kendala_data = (clone $filtered)
            ->select('ada_kendala', DB::raw('count(*) as total'))
            ->groupBy('ada_kendala')
            ->get();

        $monthlyUsers = AfterSales::selectRaw("DATE_FORMAT(tanggal_after_sales, '%Y-%m') as bulan, COUNT(DISTINCT nip) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
            
 
            $labels = $monthlyUsers->pluck('bulan');
            $data = $monthlyUsers->pluck('total');
           
        // // Ambil bulan dan tahun dari tanggal filter
        // $bulan = Carbon::parse($tanggal)->format('m');
        // $tahun = Carbon::parse($tanggal)->format('Y');

        // // Data harian user after sales dalam 1 bulan
        // $dailyUsers = AfterSales::selectRaw("DATE(tanggal_after_sales) as tanggal, COUNT(DISTINCT nip) as total")
        //     ->whereYear('tanggal_after_sales', $tahun)
        //     ->whereMonth('tanggal_after_sales', $bulan)
        //     ->groupBy('tanggal')
        //     ->orderBy('tanggal')
        //     ->get();

        // $dailyUsersByStatus = AfterSales::selectRaw("DATE(tanggal_after_sales) as tanggal, status_merchant, COUNT(DISTINCT nip) as total")
        //     ->whereYear('tanggal_after_sales', $tahun)
        //     ->whereMonth('tanggal_after_sales', $bulan)
        //     ->groupBy('tanggal', 'status_merchant')
        //     ->orderBy('tanggal')
        //     ->get();

        //  $labels = [];
        //  $dataAktif = [];
        //  $dataNonAktif = [];

        //  $datesInMonth = Carbon::parse("$tahun-$bulan-01")->daysInMonth;

        //  for ($i = 1; $i <= $datesInMonth; $i++) {
        //      $date = Carbon::create($tahun, $bulan, $i)->toDateString();
        //      $labels[] = Carbon::create($tahun, $bulan, $i)->format('d M');

        //      // Ambil data untuk tanggal dan status tertentu
        //      $aktif = $dailyUsersByStatus->firstWhere(fn($d) => $d->tanggal == $date && $d->status_merchant == 'Aktif');
        //      $nonAktif = $dailyUsersByStatus->firstWhere(fn($d) => $d->tanggal == $date && $d->status_merchant == 'nonAktif');

        //      $dataAktif[] = $aktif ? $aktif->total : 0;
        //      $dataNonAktif[] = $nonAktif ? $nonAktif->total : 0;
        //  }
    
        return view('dashboard', compact(
            'jumlah_user',
            'status_data',
            'aktif_merchant',
            'nonAktif_merchant',
            'kendala',
            'kendala_data',
            'tidakKendala',
            'tanggal', // dikirim agar date picker bisa menampilkan tanggal terpilih
            'monthlyUsers',
            'labels',
            'data',
        ));
    } 
}
