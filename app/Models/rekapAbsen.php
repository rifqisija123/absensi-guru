<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rekapAbsen extends Model
{
    use HasFactory;

    protected $table = 'rekap_absens';

    protected $fillable = [
        'uid_kartu',
        'jam_masuk',
        'status_kehadiran',
        'tanggal_absen',
    ];

    public function kartu()
    {
        return $this->belongsTo(dataGuru::class, 'uid_kartu', 'uid');
    }
}
