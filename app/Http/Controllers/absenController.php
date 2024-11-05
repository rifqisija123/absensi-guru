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

        // get uid from request and check if UID doesnt exists, return response paramater incomplete (400)
        $uidKartu = $request->query('uid_kartu');

        if (!isset($uidKartu)) {
            return response()->json(['message' => 'Parameter tidak lengkap: uid_kartu'], 400);
        }

        // check/matching uid from request query and from each model below
        $guru = dataGuru::where('uid', $uidKartu)->first();
        $tataUsaha = dataTataUsaha::where('uid', $uidKartu)->first();
        $satpam = dataSatpam::where('uid', $uidKartu)->first();

        // if UID not found
        if (!$guru && !$tataUsaha && !$satpam) {
            return response()->json(['message' => 'UID tidak ditemukan'], 404);
        }

        $tanggalAbsen = now()->toDateString();
        // Check if user has already clocked/attendance in for the day
        $rekapAbsen = rekapAbsen::where('uid_kartu', $uidKartu)
            ->whereDate('tanggal_absen', $tanggalAbsen)
            ->first();

        if (!$rekapAbsen) {
            // if uid found in one of the three job titles, then the value of $absenable is that job title
            if ($guru) {
                $absenable = $guru;
            } elseif ($tataUsaha) {
                $absenable = $tataUsaha;
            } else {
                $absenable = $satpam;
            }

            // if user has not attendance in
            $rekapAbsen = new rekapAbsen([
                'uid_kartu' => $uidKartu,
                'jam_masuk' => now()->format('H:i:s')
            ]);
            $rekapAbsen->absenable()->associate($absenable); // creates a connection between rekapAbsen dan value of $absenable
            $rekapAbsen->save();

            return response()->json([
                'message' => 'Absen masuk berhasil',
                'nama_guru' => $absenable->nama_lengkap
            ]);
        } else if ($rekapAbsen->jam_pulang) { // if user already attendance in and out
            return response()->json([
                'message' => 'Anda sudah absen masuk dan pulang hari ini'
            ]);
        } else { // if user has not attendance out
            $rekapAbsen->update([
                'jam_pulang' => now()->format('H:i:s'),
            ]);

            return response()->json([
                'message' => 'Absen pulang berhasil'
            ]);
        }
    }
}
