<?php

namespace App\Http\Controllers;

use App\Models\dataGuru;
use App\Models\temporaryUid;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class dataGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataGuru = dataGuru::latest()->paginate(10);
        return view('dataGuru', compact('dataGuru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $latestUid = temporaryUid::latest()->first();

        return view('dataGuru.create', ['latestUid' => $latestUid ? $latestUid->uid_kartu : '']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'uid' => 'required',
            'nama_lengkap' => 'required',
            'mata_pelajaran' => 'required',
            'jabatan' => 'required',
            'kelas_ajar' => 'required',
        ]);

        dataGuru::create($validated);
        return redirect()->route('data-guru.index');
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

    public function cekUid(Request $request)
    {


        $uidKartu = $request->query('uid_kartu');


        if (!$uidKartu) {
             return response()->json(['message' => 'Paramater tidak lengkap: uidKartu'], 400);
         }


        $dataGuru = dataGuru::where('uid', $uidKartu)->first();

        if($dataGuru){
            return response()->json([
                'status' => 'OK',
                'message' => 'success',
                'nama_lengkap' => $dataGuru->nama_lengkap
            ], 200);
        } else {
            return response()->json(['message' => 'Kartu tidak dikenal'], 404);
        }
    }

}