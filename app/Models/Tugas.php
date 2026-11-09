<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $fillable = ['judul', 'departemen_id', 'deadline', 'is_active'];

    protected function casts(): array
    {
        return ['deadline' => 'date', 'is_active' => 'boolean'];
    }
}
