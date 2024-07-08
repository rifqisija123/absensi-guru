<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataTataUsaha extends Model
{
    use HasFactory;

    protected $table = 'data_tata_usahas';

    protected $fillable = [
        'uid',
        'nama_lengkap',
        'jabatan',
    ];

    public function rekaps()
    {
        return $this->morphMany(rekapAbsen::class, 'absenable');
    }
}
