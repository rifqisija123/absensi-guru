<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\rekapAbsen;
use Illuminate\Http\Request;

class dataAbsenSatpamController extends Controller
{
    public function index(Request $request): View
    {
        $filterTanggal = $request->query('tanggal_absen');

        if ($filterTanggal) {
            $dataAbsenSatpam = rekapAbsen::with('absenable')
                ->where('absenable_type', 'App\Models\dataSatpam')
                ->whereDate('tanggal_absen', $filterTanggal)
                ->latest()
                ->paginate(10);
        } else {
            $dataAbsenSatpam = rekapAbsen::with('absenable')
                ->where('absenable_type', 'App\Models\dataSatpam')
                ->latest()
                ->paginate(10);
        }
        return view('dataAbsenSatpam', compact('dataAbsenSatpam'));
    }

}
