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

        $kendala_data = AfterSales::select(
            'ada_kendala', DB::raw('count(*) as total')
        )
        ->groupBy('ada_kendala')
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
