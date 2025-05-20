<?php

namespace App\Http\Controllers;

use App\Models\AfterSales;
use Illuminate\Http\Request;

class AfterSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AfterSales::latest()->get();

        return view('after-sales.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('after-sales.create');
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_akuisisi' => 'required|date',
            'merchant' => 'required',
            'tanggal_after_sales' => 'required|date',
            'kode_cabang' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'status_merchant' => 'required|in:Aktif,nonAktif',
            'kendala' => 'required',
            'cross_selling' => 'required',
        ]);

        AfterSales::create($request->all());

        return redirect()->route('after-sales.create')->with('success', 'Data berhasil disimpan!');
    }
    public function export()
    {
    $data = \App\Models\AfterSales::all(); // Pastikan modelnya sesuai

        $csv = "\"Tanggal After Sales\",\"NIP\",\"Jabatan\",\"Kode Cabang\",\"Merchant\",\"Tanggal Akuisisi\",\"Status Merchant\",\"Kendala\",\"Cross Selling\",\"Created At\"\n";

     foreach ($data as $row) {
        $csv .= '"' . $this->escapeCsv($row->tanggal_after_sales) . '",'
              . '"' . $this->escapeCsv($row->nip) . '",'
              . '"' . $this->escapeCsv($row->jabatan) . '",'
              . '"' . $this->escapeCsv($row->kode_cabang) . '",'
              . '"' . $this->escapeCsv($row->merchant) . '",'
              . '"' . $this->escapeCsv($row->tanggal_akuisisi) . '",'
              . '"' . $this->escapeCsv($row->status_merchant) . '",'
              . '"' . $this->escapeCsv($row->kendala) . '",'
              . '"' . $this->escapeCsv($row->cross_selling) . '",'
              . '"' . $row->created_at->format('d-m-Y') . '"' . "\n";
    }
    return response($csv)
        ->header('Content-Type', 'text/csv')
        ->header('Content-Disposition', 'attachment; filename="after_sales_export.csv"');
    }
    private function escapeCsv($value)
    {
        $escaped = str_replace('"', '""', $value); // Escape kutip ganda
        return $escaped;
    }  

}

//     /**
//      * Display the specified resource.
//      */
//     public function show(AfterSales $afterSales)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(AfterSales $afterSales)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, AfterSales $afterSales)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(AfterSales $afterSales)
//     {
//         //
//     }
// }
