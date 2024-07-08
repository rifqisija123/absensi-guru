<?php

namespace App\Http\Controllers;

use App\Models\dataGuru;
use App\Models\dataSatpam;
use App\Models\rekapAbsen;
use Illuminate\Http\Request;
use App\Models\dataTataUsaha;

class LogGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tanggalAbsen = now()->toDateString();
        $dataGuru = dataGuru::all();
        $dataAbsenGuru = rekapAbsen::whereDate('tanggal_absen', $tanggalAbsen)->get();

        $guruBelumAbsen = $dataGuru->filter(function ($guru) use ($dataAbsenGuru) {
            return !$dataAbsenGuru->contains('uid_kartu', $guru->uid);
        });

        // $dataGuru = dataGuru::latest()->paginate(10);
        return view('logGuru', compact('guruBelumAbsen'));
    }

    public function setKehadiran(Request $request)
    {
        $validated = $request->validate([
            'uid_kartu' => 'required',
            'status_kehadiran' => 'required|in:Hadir,Izin,Sakit',
        ]);

        $uid = $request->input('uid_kartu');
        $statusKehadiran = $request->input('status_kehadiran');
        $tanggalAbsen = now()->toDateString();

        $rekapAbsen = rekapAbsen::where('uid_kartu', $uid)
            ->where('tanggal_absen', $tanggalAbsen)
            ->first();

        // Cari entitas guru, tata usaha, atau satpam berdasarkan UID
        $guru = dataGuru::where('uid', $uid)->first();
        $tataUsaha = dataTataUsaha::where('uid', $uid)->first();
        $satpam = dataSatpam::where('uid', $uid)->first();

        if (!$rekapAbsen) {
            // $rekapAbsen = new rekapAbsen();
            // $rekapAbsen->uid_kartu = $uid;
            // $rekapAbsen->status_kehadiran = $statusKehadiran;
            // $rekapAbsen->tanggal_absen = $tanggalAbsen;
            // $rekapAbsen->save();

            $rekapAbsen = rekapAbsen::create([
                'uid_kartu' => $uid,
                'tanggal_absen' => $tanggalAbsen,
                'jam_masuk' => ($statusKehadiran === 'Hadir') ? now() : null,
                'status_kehadiran' => $statusKehadiran,
                'absenable_type' => $guru ? dataGuru::class : ($tataUsaha ? dataTataUsaha::class : dataSatpam::class),
                'absenable_id' => $guru ? $guru->id : ($tataUsaha ? $tataUsaha->id : $satpam->id),
            ]);
        }
        // else {
        //     $rekapAbsen->update([
        //         'status_kehadiran' => $statusKehadiran,
        //         'jam_masuk' => ($statusKehadiran === 'Hadir') ? $rekapAbsen->jam_masuk : null,
        //     ]);
        // }
        return redirect()->route('log-guru.index')->with('success', 'Status kehadiran berhasil diperbarui.');
    }
}


// $rekapAbsen->update([
//     'status_kehadiran' => $statusKehadiran,
//     'jam_masuk' => ($statusKehadiran === 'Hadir') ? $rekapAbsen->jam_masuk : null,
// ]);

// $rekapAbsen->status_kehadiran = $statusKehadiran;
// $rekapAbsen->save();