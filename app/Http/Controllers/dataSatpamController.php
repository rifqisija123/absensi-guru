<?php

namespace App\Http\Controllers;

use App\Models\dataSatpam;
use App\Models\rekapAbsen;
use App\Models\temporaryUid;
use Illuminate\Http\Request;

class dataSatpamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSatpam = dataSatpam::latest()->paginate(10);
        return view('dataSatpam.index', compact('dataSatpam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $latestUid = temporaryUid::latest()->first();
        return view('dataSatpam.create', ['latestUid' => $latestUid ? $latestUid->uid_kartu : '']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'uid' => 'required',
            'nama_lengkap' => 'required',
            'jabatan' => 'required',
        ]);

        dataSatpam::create($validated);
        return redirect()->route('data-satpam.index');
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
        $dataSatpam = dataSatpam::findOrFail($id);
        return view('dataSatpam.update', compact('dataSatpam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|max:255',
            'jabatan' => 'required',
        ]);

        dataSatpam::findOrFail($id)->update($validated);
        return redirect()->route('data-satpam.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataAbsen = rekapAbsen::where('uid_kartu', dataSatpam::findOrFail($id)->uid)->get();
        foreach ($dataAbsen as $absen) {
            $absen->delete();
        }

        dataSatpam::findOrFail($id)->delete();
        return redirect()->route('data-satpam.index')->with('success', 'Data satpam berhasil dihapus');
    }
}
