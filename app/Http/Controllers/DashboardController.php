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

        return view('dashboard', compact(
            'jumlah_user',
            'status_data',
            'aktif_merchant',
            'nonAktif_merchant',
            'kendala',
            'kendala_data',
            'tidakKendala',
            'tanggal' // dikirim agar date picker bisa menampilkan tanggal terpilih
        ));
    }
    }
