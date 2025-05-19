<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AfterSales;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah user yang melakukan after sales
        $jumlah_user = \App\Models\AfterSales::select('nip')->distinct()->count();

        // Pie Chart Status Merchant
         $status_data = AfterSales::select('status_merchant', DB::raw('count(*) as total'))
             ->groupBy('status_merchant')
             ->get();

        // Status merchant: Aktif vs Non Aktif
        $aktif_merchant = AfterSales::where('status_merchant', 'Aktif')->count();
        $nonAktif_merchant = AfterSales::where('status_merchant', 'nonAktif')->count();

        // Kendala: Ya vs Tidak
        $kendala = AfterSales::where('kendala', '!=', '-')->whereNotNull('kendala')->count();
        $tidakKendala = AfterSales::where('kendala', '-')->orWhereNull('kendala')->count();

        // Pie Chart Kendala Merchant (hitung "-" sebagai 'Tidak Ada Kendala', lainnya sebagai 'Ada Kendala')
         $kendala_data = AfterSales::select(
                 DB::raw("CASE WHEN kendala = '-' THEN 'Tidak Ada Kendala' ELSE 'Ada Kendala' END as kendala"),
                 DB::raw('count(*) as total')
        )
             ->groupBy('kendala')
             ->get();

        return view('dashboard', compact(
            'jumlah_user',
            'status_data',
            'aktif_merchant',
            'nonAktif_merchant',
            'kendala',
            'kendala_data',
            'tidakKendala'
        ));
    }
}
