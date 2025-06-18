<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonitoringEDC; 


class MonitoringEDCController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = MonitoringEDC::orderBy('tanggal_mti', 'desc')->paginate(10);
        //return view('monitoring-edc.indexEDC', compact('data')); // pastikan ini sesuai dengan nama view

            $query = MonitoringEDC::query();

        // Filter pencarian
        if ($search = $request->search) {
            $query->where('merchant', 'like', "%{$search}%")
                ->orWhere('official_name', 'like', "%{$search}%")
                ->orWhere('progress', 'like', "%{$search}%");
        }

        // Sorting
        $sort = $request->get('sort', 'tanggal_mti');
        $direction = $request->get('direction', 'desc');
        $query->orderBy($sort, $direction);

        $data = $query->paginate(10);

        return view('monitoring-edc.indexEDC', compact('data', 'sort', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('monitoring-edc.createEDC');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_rekening' => 'required|string',
            'tanggal_mti' => 'required|date',
            'merchant' => 'required|string',
            'official_name' => 'required|string',
            'alamat' => 'required|string',
            'kd_cabang' => 'required|string',
            'progress' => 'required|string',
            'keterangan_merchant' => 'nullable|string',
            'kategori' => 'nullable|string',
            'MID' => 'nullable|string',
            'deadline' => 'nullable|date',
            'status' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        MonitoringEDC::create($request->all());

        return redirect()->route('monitoring-edc.index')->with('success', 'Data deploy EDC berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = MonitoringEDC::findOrFail($id);
        return view('monitoring-edc.editEDC', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_rekening' => 'required|string',
            'tanggal_mti' => 'required|date',
            'merchant' => 'required|string',
            'official_name' => 'required|string',
            'alamat' => 'required|string',
            'kd_cabang' => 'required|string',
            'progress' => 'required|string',
            'keterangan_merchant' => 'nullable|string',
            'kategori' => 'nullable|string',
            'MID' => 'nullable|string',
            'deadline' => 'nullable|date',
            'status' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $data = MonitoringEDC::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('monitoring-edc.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = MonitoringEDC::findOrFail($id);
        $data->delete();

        return redirect()->route('monitoring-edc.index')->with('success', 'Data berhasil dihapus!');
    }

    public function export()
    {
        $data = MonitoringEDC::all();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="monitoring_edc.csv"',
        ];

        $columns = [
            'no_rekening',
            'tanggal_mti',
            'merchant',
            'official_name',
            'alamat',
            'kd_cabang',
            'progress',
            'keterangan_merchant',
            'kategori',
            'MID',
            'deadline',
            'status',
            'keterangan',
        ];

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, $columns);

            // Isi data
            foreach ($data as $row) {
                $rowArray = [];
                foreach ($columns as $column) {
                    $rowArray[] = $row->{$column};
                }
                fputcsv($file, $rowArray);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
