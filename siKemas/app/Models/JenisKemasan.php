<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKemasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kwt_id',
        'nama_kemasan',
        'deskripsi_kemasan',
        'ikon_kemasan',
    ];

    public function kwt()
    {
        return $this->belongsTo(Kwt::class);
    }

    public function desains()
    {
        return $this->hasMany(Desain::class);
    }
}