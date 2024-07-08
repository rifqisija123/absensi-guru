<?php

namespace App\Http\Controllers;

use App\Models\dataGuru;
use App\Models\dataTataUsaha;
use App\Models\temporaryUid;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class dataTataUsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $dataTataUsaha = dataTataUsaha::latest()->paginate(10);
        return view('dataTataUsaha', compact('dataTataUsaha'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
