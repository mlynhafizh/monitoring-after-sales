<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileMerchant;

class ProfileMerchantController extends Controller
{
    public function index()
    {
        $merchants = ProfileMerchant::all();
        return view('profile-merchant.listProfile', compact('merchants'));
    }

    public function create()
    {
        return view('profile-merchant.createProfile');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'tanggal_gabung' => 'required',
        //     'nama_merchant' => 'required',
        //     'alamat' => 'required',
        //     'payroll' => 'required|in:Y,N',
        //     'deposito'=> 'requiredin|in:Y,N', 
        //     'mtb' => 'required|in:Y,N',
        //     'giro' => 'required|in:Y,N',
        //     'kredit_sme' => 'required|in:Y,N', 
        //     'kredit_kum_kur' => 'required|in:Y,N',
        //     'mandiri_cm' => 'required|in:Y,N',
        //     'livin' => 'required|in:Y,N'
        // ]);

        ProfileMerchant::create($request->all());

        return redirect()->route('profile-merchant.store')->with('success', 'Data berhasil disimpan');
    }
}
