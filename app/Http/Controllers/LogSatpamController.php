<?php

namespace App\Http\Controllers;

use App\Models\dataGuru;
use App\Models\dataSatpam;
use App\Models\rekapAbsen;
use Illuminate\Http\Request;
use App\Models\dataTataUsaha;

class LogSatpamController extends Controller
{
    public function index()
    {
        $tanggalAbsen = now()->toDateString();
        $dataSatpam = dataSatpam::all();
        $rekapAbsen = rekapAbsen::whereDate('tanggal_absen', $tanggalAbsen)->get();

        $satpamBelumAbsen = $dataSatpam->filter(function ($satpam) use ($rekapAbsen) {
            return !$rekapAbsen->contains('uid_kartu', $satpam->uid);
        });

        return view('LogSatpam', compact('satpamBelumAbsen'));
    }

    public function setKehadiran(Request $request)
    {
        $request->validate([
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
            $rekapAbsen = rekapAbsen::create([
                'uid_kartu' => $uid,
                'tanggal_absen' => $tanggalAbsen,
                'jam_masuk' => ($statusKehadiran === 'Hadir') ? now() : null,
                'status_kehadiran' => $statusKehadiran,
                'absenable_type' => $guru ? dataGuru::class : ($tataUsaha ? dataTataUsaha::class : dataSatpam::class),
                'absenable_id' => $guru ? $guru->id : ($tataUsaha ? $tataUsaha->id : $satpam->id),
            ]);
        }
        return redirect()->route('log-satpam.index')->with('success', 'Status kehadiran berhasil diperbarui.');
    }
}
