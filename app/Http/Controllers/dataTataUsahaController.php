<?php

namespace App\Http\Controllers;

use App\Models\dataGuru;
use Illuminate\View\View;
use App\Models\rekapAbsen;
use App\Models\temporaryUid;
use Illuminate\Http\Request;
use App\Models\dataTataUsaha;
use Illuminate\Http\RedirectResponse;

class dataTataUsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $dataTataUsaha = dataTataUsaha::latest()->paginate(10);
        return view('dataTataUsaha.index', compact('dataTataUsaha'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $latestUid = temporaryUid::latest()->first();

        return view('dataTataUsaha.create', ['latestUid' => $latestUid ? $latestUid->uid_kartu : '']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'uid' => 'required',
            'nama_lengkap' => 'required',
            'jabatan' => 'required',
        ]);

        dataTataUsaha::create($validated);
        return redirect()->route('data-tata-usaha.index');
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
        $dataTataUsaha = dataTataUsaha::findOrFail($id);
        return view('dataTataUsaha.update', compact('dataTataUsaha'));
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

        dataTataUsaha::findOrFail($id)->update($validated);
        return redirect()->route('data-tata-usaha.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataAbsen = rekapAbsen::where('uid_kartu', dataTataUsaha::findOrFail($id)->uid)->get();
        foreach ($dataAbsen as $absen) {
            $absen->delete();
        }

        dataTataUsaha::findOrFail($id)->delete();
        return redirect()->route('data-tata-usaha.index')->with('success', 'Data tata usaha berhasil dihapus');
    }
}
