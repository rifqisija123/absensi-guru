<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class rekapAbsen extends Model
{
    use HasFactory;

    protected $table = 'rekap_absens';

    protected $fillable = [
        'uid_kartu',
        'jam_masuk',
        'status_kehadiran',
        'tanggal_absen',
        'jam_pulang',
        'absenable_type',
        'absenable_id'
    ];

    public function absenable()
    {
        return $this->morphTo();
    }
}
