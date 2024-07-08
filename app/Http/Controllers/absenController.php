<?php

namespace App\Http\Controllers;

use App\Models\dataGuru;
use App\Models\dataSatpam;
use App\Models\rekapAbsen;
use Illuminate\Http\Request;
use App\Models\dataTataUsaha;
use Illuminate\Support\Facades\Log;

class absenController extends Controller
{
    public function absen(Request $request)
    {
        $uidKartu = $request->query('uid_kartu');

        if (!isset($uidKartu)) {
            return response()->json(['message' => 'Parameter tidak lengkap: uid_kartu'], 400);
        }

        $guru = dataGuru::where('uid', $uidKartu)->first();
        $tataUsaha = dataTataUsaha::where('uid', $uidKartu)->first();
        $satpam = dataSatpam::where('uid', $uidKartu)->first();

        if (!$guru && !$tataUsaha && !$satpam) {
            return response()->json(['message' => 'UID tidak ditemukan'], 404);
        }

        $tanggalAbsen = now()->toDateString();
        $rekapAbsen = rekapAbsen::where('uid_kartu', $uidKartu)
            ->whereDate('tanggal_absen', $tanggalAbsen)
            ->first();

        if (!$rekapAbsen) {
            if ($guru) {
                $absenable = $guru;
            } elseif ($tataUsaha) {
                $absenable = $tataUsaha;
            } else {
                $absenable = $satpam;
            }

            $rekapAbsen = new rekapAbsen([
                'uid_kartu' => $uidKartu,
                'jam_masuk' => now()->format('H:i:s')
            ]);
            $rekapAbsen->absenable()->associate($absenable);
            $rekapAbsen->save();

            return response()->json([
                'message' => 'Absen masuk berhasil',
                'nama_guru' => $absenable->nama_lengkap,
                'jam_masuk' => $rekapAbsen->jam_masuk
            ]);
        } else if ($rekapAbsen->jam_pulang) {
            return response()->json([
                'message' => 'Anda sudah absen masuk dan pulang hari ini'
            ]);
        } else {
            $rekapAbsen->update([
                'jam_pulang' => now()->format('H:i:s'),
            ]);

            return response()->json([
                'message' => 'Absen pulang berhasil'
            ]);
        }
    }
}
