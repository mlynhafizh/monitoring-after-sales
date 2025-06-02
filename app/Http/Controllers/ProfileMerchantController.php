<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileMerchant;

class ProfileMerchantController extends Controller
{
    public function index(Request $request)
    {
        $query = ProfileMerchant::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_merchant', 'like', "%$search%")
                ->orWhere('alamat', 'like', "%$search%");
            });
        }

        $tanggalFilter = $request->get('tanggal_filter');
         if ($tanggalFilter) {
             $query->whereDate('tanggal_gabung', $tanggalFilter);
         }


        // Sorting
        $sort = $request->input('sort', 'tanggal_gabung');
        $direction = $request->input('direction', 'asc');
        $query->orderBy($sort, $direction);

        $merchants = $query->paginate(10)->appends($request->all());

        return view('profile-merchant.listProfile', [
            'merchants' => $merchants,
            'sort' => $sort,
            'direction' => $direction
        ]);
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

        $csv = "\"Tgl Akuisisi\",\"Nama Merchant\",\"Alamat\",\"No HP/Telepon\",\"Payroll\",\"Deposito\",\"MTB\",\"Giro\",\"Kredit SME\",\"Kredit KUM/KUR\",\"Mandiri CM\",\"Livin\",\"Created At\"\n";

     foreach ($data as $row) {
        $csv .= '"' . $this->escapeCsv($row->tanggal_gabung) . '",'
              . '"' . $this->escapeCsv($row->nama_merchant) . '",'
              . '"' . $this->escapeCsv($row->alamat) . '",'
              . '"' . $this->escapeCsv($row->no_hp) . '",'
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
    public function edit($id)
    {
        $merchant = ProfileMerchant::findOrFail($id);
        return view('profile-merchant.editProfile', compact('merchant'));
    }

    public function update(Request $request, $id)
    {
        $merchant = ProfileMerchant::findOrFail($id);
        $merchant->update($request->all());

        return redirect()->route('profile-merchant.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $merchant = ProfileMerchant::findOrFail($id);
        $merchant->delete();

        return redirect()->route('profile-merchant.index')->with('success', 'Data berhasil dihapus');
    }
}
