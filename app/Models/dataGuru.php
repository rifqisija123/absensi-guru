<?php

namespace App\Models;

use App\Models\rekapAbsen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class dataGuru extends Model
{
    use HasFactory;

    protected $table = 'data_gurus';

    protected $fillable = [
        'uid',
        'nama_lengkap',
        'mata_pelajaran',
        'jabatan',
        'kelas_ajar',
    ];

    public function rekaps()
    {
        return $this->hasMany(rekapAbsen::class, 'uid_kartu', 'uid');
    }

}
