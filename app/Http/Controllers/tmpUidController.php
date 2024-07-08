<?php

namespace App\Http\Controllers;

use App\Models\temporaryUid;
use Illuminate\Http\Request;

class tmpUidController extends Controller
{
    public function kirimUid(Request $request)
    {

        $uidKartu = $request->query('uid_kartu');

        if (!$uidKartu) {
            return response()->json(['message' => 'Parameter tidak lengkap: uid_kartu'], 400);
        }

        $temporaryUid = temporaryUid::first();

        if ($temporaryUid && $temporaryUid->uid_kartu === $uidKartu) {
            return response()->json([
                'message' => 'UID sudah ada di database'], 200);
        }

        temporaryUid::truncate();
        temporaryUid::create(['uid_kartu' => $uidKartu]);

        return response()->json(['message' => 'UID berhasil disimpan']);

    }
}
