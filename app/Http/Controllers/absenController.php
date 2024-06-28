<?php

namespace App\Http\Controllers;

use App\Models\dataGuru;
use App\Models\rekapAbsen;
use Illuminate\Http\Request;

class absenController extends Controller
{
    public function absen(Request $request)
    {
        $uidKartu = $request->query('uid_kartu');

        if (!isset($uidKartu)) {
            return response()->json(['message' => 'Parameter tidak lengkap: uid_kartu'], 400);
        }

        $guru = dataGuru::where('uid', $uidKartu)->first();

        if ($guru) {
            $jamMasuk = now()->format('H:i:s');
            $statusKehadiran = $jamMasuk >= '07:00:00' ? 'Hadir Tepat Waktu' : 'Hadir Terlambat';
            $tanggalAbsen = now()->toDateString();

            $duplikasiAbsen = rekapAbsen::where('uid_kartu', $uidKartu)
                ->where('tanggal_absen', $tanggalAbsen)
                ->exists();

            if ($duplikasiAbsen) {
                return response()->json(['message' => 'Anda sudah absen masuk hari ini']);
            } else {
                rekapAbsen::create([
                    'uid_kartu' => $uidKartu,
                    'jam_masuk' => $jamMasuk,
                    'status_kehadiran' => $statusKehadiran,
                    'tanggal_absen' => $tanggalAbsen
                ]);

                return response()->json([
                    'message' => 'Absen berhasil',
                    'namaGuru' => $guru->nama_lengkap,
                    'jam' => $jamMasuk
                ]);
            }
        } else {
            return response()->json(['message' => 'UID tidak ditemukan di tabel guru'], 404);
        }
    }
}
