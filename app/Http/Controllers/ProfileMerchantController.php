<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileMerchant;

class ProfileMerchantController extends Controller
{
    public function index(Request $request)
    {
        // $sort = $request->get('sort', 'tanggal_gabung'); // default sort
        // $direction = $request->get('direction', 'asc');  // default direction

        // $merchants = ProfileMerchant::orderBy($sort, $direction)->get();

        // return view('profile-merchant.listProfile', compact('merchants', 'sort', 'direction'));
        $sort = $request->get('sort', 'tanggal_gabung');
        $direction = $request->get('direction', 'desc');
        $tanggalFilter = $request->get('tanggal_filter');

        $query = ProfileMerchant::orderBy($sort, $direction);

        if ($tanggalFilter) {
            $query->whereDate('tanggal_gabung', $tanggalFilter);
        }

        $merchants = $query->get();

        return view('profile-merchant.listProfile', compact('merchants', 'sort', 'direction'));
    }

    public function create()
    {
        return view('profile-merchant.createProfile');
    }

    public function store(Request $request)
    {

        ProfileMerchant::create($request->all());

        return redirect()->route('profile-merchant.store')->with('success', 'Data berhasil disimpan');
    }
    public function export()
    {
    $data = \App\Models\ProfileMerchant::all(); // Pastikan modelnya sesuai

        $csv = "\"Tgl Akuisisi\",\"Nama Merchant\",\"Alamat\",\"Payroll\",\"Deposito\",\"MTB\",\"Giro\",\"Kredit SME\",\"Kredit KUM/KUR\",\"Mandiri CM\",\"Livin\",\"Created At\"\n";

     foreach ($data as $row) {
        $csv .= '"' . $this->escapeCsv($row->tanggal_gabung) . '",'
              . '"' . $this->escapeCsv($row->nama_merchant) . '",'
              . '"' . $this->escapeCsv($row->alamat) . '",'
              . '"' . $this->escapeCsv($row->payroll) . '",'
              . '"' . $this->escapeCsv($row->deposito) . '",'
              . '"' . $this->escapeCsv($row->mtb) . '",'
              . '"' . $this->escapeCsv($row->giro) . '",'
              . '"' . $this->escapeCsv($row->kredit_sme) . '",'
              . '"' . $this->escapeCsv($row->kredit_kum_kur) . '",'
              . '"' . $this->escapeCsv($row->mandiri_cm) . '",'
              . '"' . $this->escapeCsv($row->livin) . '",'
              . '"' . $row->created_at->format('d-m-Y') . '"' . "\n";
    }
    return response($csv)
        ->header('Content-Type', 'text/csv')
        ->header('Content-Disposition', 'attachment; filename="profile_merchant.csv"');
    }
    private function escapeCsv($value)
    {
        $escaped = str_replace('"', '""', $value); // Escape kutip ganda
        return $escaped;
    }  
}
