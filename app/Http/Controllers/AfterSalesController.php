<?php

namespace App\Http\Controllers;

use App\Models\AfterSales;
use Illuminate\Http\Request;

class AfterSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'tanggal_after_sales');
        $direction = $request->get('direction', 'desc');
        $tanggalFilter = $request->get('tanggal_filter');
        $search = $request->get('search');
        
        $query = AfterSales::orderBy($sort, $direction);

        if ($tanggalFilter) {
            $query->whereDate('tanggal_after_sales', $tanggalFilter);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('merchant', 'like', "%$search%")
                ->orWhere('kendala', 'like', "%$search%");
            });
        }
 

        $data = $query->paginate(10);


        return view('after-sales.index', compact('data', 'sort', 'direction'));
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
            'cross_selling' => 'required',
            'ada_kendala' => 'required|in:Ada,Tidak ada',
            'kendala' => 'nullable|string',
        ]);

        $ada_kendala = $request->input('ada_kendala');
        $kendala = $request->input('kendala') ?? '-';
        // $kendala = $request->input('ada_kendala') === 'Ada'
        //     ? $request->input('kendala')
        //     : '-';

        AfterSales::create([
            'tanggal_akuisisi' => $request->input('tanggal_akuisisi'),
            'merchant' => $request->input('merchant'),
            'tanggal_after_sales' => $request->input('tanggal_after_sales'),
            'kode_cabang' => $request->input('kode_cabang'),
            'nip' => $request->input('nip'),
            'jabatan' => $request->input('jabatan'),
            'status_merchant' => $request->input('status_merchant'),
            'kendala' => $kendala,
            'ada_kendala' => $ada_kendala,
            'cross_selling' => $request->input('cross_selling'),
        ]);

        return redirect()->route('after-sales.create')->with('success', 'Data berhasil disimpan!');
    }
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'tanggal_akuisisi' => 'required|date',
        //     'merchant' => 'required',
        //     'tanggal_after_sales' => 'required|date',
        //     'kode_cabang' => 'required',
        //     'nip' => 'required',
        //     'jabatan' => 'required',
        //     'status_merchant' => 'required|in:Aktif,nonAktif',
        //     'kendala' => 'required',
        //     'cross_selling' => 'required',
        // ]);

        // $afterSales = AfterSales::findOrFail($id);
        // $afterSales->update($request->all());

        // return redirect()->route('after-sales.index')->with('success', 'Data berhasil diperbarui!');
            $request->validate([
                'tanggal_akuisisi' => 'required|date',
                'merchant' => 'required',
                'tanggal_after_sales' => 'required|date',
                'kode_cabang' => 'required',
                'nip' => 'required',
                'jabatan' => 'required',
                'status_merchant' => 'required|in:Aktif,nonAktif',
                'cross_selling' => 'required',
                'ada_kendala' => 'required|in:Ada,Tidak ada',
                'kendala' => 'nullable|string',
            ]);

            $afterSales = AfterSales::findOrFail($id);

            $kendala = $request->input('ada_kendala') === 'Ada'
                ? $request->input('kendala')
                : '-';

            $afterSales->update([
                'tanggal_akuisisi' => $request->input('tanggal_akuisisi'),
                'merchant' => $request->input('merchant'),
                'tanggal_after_sales' => $request->input('tanggal_after_sales'),
                'kode_cabang' => $request->input('kode_cabang'),
                'nip' => $request->input('nip'),
                'jabatan' => $request->input('jabatan'),
                'status_merchant' => $request->input('status_merchant'),
                'kendala' => $kendala,
                'ada_kendala' => $ada_kendala,
                'cross_selling' => $request->input('cross_selling'),
            ]);

            return redirect()->route('after-sales.index')->with('success', 'Data berhasil diperbarui!');

    }


    public function destroy($id)
    {
        $afterSales = AfterSales::findOrFail($id);
        $afterSales->delete();

        return redirect()->route('after-sales.index')->with('success', 'Data berhasil dihapus!');
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
    
    public function edit($id)
    {
        $afterSales = AfterSales::findOrFail($id);
        return view('after-sales.edit', compact('afterSales'));
    }

}
