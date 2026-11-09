<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = ['nrp', 'nama', 'email', 'departemen_id', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
