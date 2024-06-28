<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temporaryUid extends Model
{
    use HasFactory;

    protected $table = 'temporary_uids';

    protected $fillable = [
        'uid_kartu',
    ];
}
