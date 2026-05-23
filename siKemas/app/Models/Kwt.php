<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kwt extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kwt',
        'no_kwt',
        'alamat_kwt',
        'desa',
    ];

    // Relasi ke User
    public function users()
    {
        return $this->hasMany(User::class, 'kwt_id');
    }
}